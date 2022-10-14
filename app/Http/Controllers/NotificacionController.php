<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Notificacion;
use App\Models\Profesor;
use App\Models\supervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Illuminate\Support\Facades\Storage;


class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Notificacion::join('tipo_notificacions','notificacions.id_tipo_actividad','=','tipo_notificacions.id' )
        ->join('establecimientos','notificacions.id_establecimiento','=','establecimientos.id_establecimiento')
        ->join('profesors','notificacions.id_profesor','=','profesors.id')
        ->select('notificacions.*', 'tipo_notificacions.descripcion','establecimientos.nombre',
        DB::raw("CONCAT(profesors.nombres,' ',profesors.apellidos) AS Profesor"),
        DB::raw("IF(notificacions.estado = TRUE,'NO LEIDA','LEIDA') AS state"))
        ->get();
        
    }

    public function misnotificaciones($id){
        try {
            //code...
            $user = User::findOrFail($id);
            $rol = $user->roles()->get();
            if($rol[0]->id==1){
                $supervisor = supervisor::where("id_usuario","=",$id)->get();
                return Notificacion::where("user_id","=",$supervisor[0]->id_usuario)->get();
            }
            if($rol[0]->id == 2)
            {
                $profesor = Profesor::where("id_usuario","=",$id)->get();
                return Notificacion::where("id_profesor","=",$profesor[0]->id)->get();
            } 
            
            }
            
         catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "No se encontro el usuario." ,
                
            ]);

        }
        
    }

    public function misnotificacionesleidas($id){
        try {
            //code...
            $user = User::findOrFail($id);
            $rol = $user->roles()->get();
            if($rol[0]->id==1){
                $supervisor = supervisor::where("id_usuario","=",$id)->get();
                return response()->json([ "leidas"=>count (Notificacion::where("user_id","=",$supervisor[0]->id_usuario)
                                     ->where("estado","=",false)->get()),]);
            }
            if($rol[0]->id == 2)
            {
                $profesor = Profesor::where("id_usuario","=",$id)->get();
                return response()->json ([
                    "leidas" => count(Notificacion::where("id_profesor","=",$profesor[0]->id)->where("estado","=",false)->get()),
                ]);
            } 
            
            }
            
         catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "No se encontro el usuario." ,
                
            ]);

        }
        
    }

    public function misnotificacionesnoleidas($id){
        try {
            //code...
            $user = User::findOrFail($id);
            $rol = $user->roles()->get();
            if($rol[0]->id==1){
                $supervisor = supervisor::where("id_usuario","=",$id)->get();
                return response()->json([ "sin leer"=>count (Notificacion::where("user_id","=",$supervisor[0]->id_usuario)
                                     ->where("estado","=",true)->get()),]);
            }
            if($rol[0]->id == 2)
            {
                $profesor = Profesor::where("id_usuario","=",$id)->get();
                return response()->json ([
                    "sin leer" => count(Notificacion::where("id_profesor","=",$profesor[0]->id)->where("estado","=",true)->get()),
                ]);
            } 
            
            }
            
         catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "No se encontro el usuario." ,
                
            ]);

        }
        
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        /*
        $validator = Validator::make($request->all(), 
        [ 
        'id_tipo_actividad' => 'required',
        'user_id' =>'required',
        'file' => 'required|mimes:doc,docx,pdf,png,jpg|max:2048',
       ]);*/

       $validator = Validator::make($request->all(), 
        [ 
        'id_tipo_actividad' => 'required',
        'user_id' =>'required',
       ]);

if ($validator->fails()) {          
      return response()->json(['error'=>$validator->errors()], 401);                        
   }  

/*
  if ($files = $request->file('file')) {
  */
  //Si la notificacion es a nivel general, se genera para todos los profesores en el sistema
  if($request->id_tipo_actividad == 1) 
    {  
      //store file into document folder
      /* $file = $request->file->store('public/documents'); */
      $contador =0;
      $profesores = Profesor::where('estado','=',true)->get();
      if($request->has('sharedfile')){
        $file = $request->sharedfile->store('public/documents'); 
      }
      foreach ($profesores as $profesor) {
        $notificacion = new Notificacion();
        $notificacion->id_tipo_actividad = $request->id_tipo_actividad;        
        $notificacion->titulo_actividad = $request->titulo_actividad;
        $notificacion->descripcion = $request->descripcion;
        $notificacion->fecha_inicial = $request->fecha_inicial;
        $notificacion->fecha_final = $request->fecha_final;
        if($request->has('sharedfile')){            
            $notificacion->sharedfilepath = $file; // direccion del archivo compartido por el supervisor
        }        
        $notificacion->user_id = $request->user_id; // el ID del que genero la notificacion(usuario del supervisor)
        $notificacion->id_profesor = $profesor->id; 
        $notificacion->id_establecimiento = $profesor->id_establecimiento;       
        $notificacion->save();
        $contador++;

        
      }
      return response()->json([
        "success" => true,
        "message" => $contador . " Notificacion(es) creada(s) correctamente.",
        
    ]);
      /* 
      //store your file into database
      $notificacion = new Notificacion();
      $notificacion->id_tipo_actividad = $request->id_tipo_actividad;
      $notificacion->filepath = $file; // direccion del archivo
      $notificacion->titulo_actividad = $request->titulo_actividad;
      $notificacion->descripcion = $request->descripcion;
      $notificacion->fecha_inicial = $request->fecha_inicial;
      $notificacion->fecha_final = $request->fecha_final;
      $notificacion->user_id = $request->user_id;
      $notificacion->id_profesor = $request->id_profesor;
      $notificacion->id_establecimiento = $request->id_establecimiento;
      $notificacion->save();
    */   }  //END IF   

    if($request->id_tipo_actividad == 3 || $request->id_tipo_actividad == 2)
    {
        $contador=0;
          
          if(!is_null($request->id_profesor) && is_null($request->id_establecimiento) ){
          $id=$request->id_profesor;
          $data =  Profesor::findOrFail($id);
          $notificacion = new Notificacion();
          $notificacion->id_profesor = $data->id; 
          $notificacion->id_establecimiento = $data->id_establecimiento;        
          $notificacion->id_tipo_actividad = $request->id_tipo_actividad;        
          $notificacion->titulo_actividad = $request->titulo_actividad;
          $notificacion->descripcion = $request->descripcion;
          if(!is_null($request->sharedfile)){
            $file = $request->sharedfile->store('public/documents'); 
            $notificacion->sharedfilepath = $file; // direccion del archivo compartido por el supervisor
        } 
          $notificacion->fecha_inicial = $request->fecha_inicial;
          $notificacion->fecha_final = $request->fecha_final;
          $notificacion->user_id = $request->user_id; // el ID del que genero la notificacion(usuario del supervisor)
          $notificacion->save();
          $contador++;
          
          }
  
          if(!is_null($request->id_establecimiento)){
              //Regresando todos lo profesores que pertenezcan al establecimiento.
              $id=$request->id_establecimiento;
              $profesores =  Profesor::where('id_establecimiento',$id)->get();
              if(!is_null($request->sharedfile)){
                $file = $request->sharedfile->store('public/documents'); 
              }
              foreach ($profesores as $profesor) {
                  $notificacion = new Notificacion();
                  $notificacion->id_profesor = $profesor->id; 
                  $notificacion->id_establecimiento = $profesor->id_establecimiento;        
                  $notificacion->id_tipo_actividad = $request->id_tipo_actividad;        
                  $notificacion->titulo_actividad = $request->titulo_actividad;
                  $notificacion->descripcion = $request->descripcion;
                  if(!is_null($request->sharedfile)){                    
                    $notificacion->sharedfilepath = $file; // direccion del archivo compartido por el supervisor
                } 
                  $notificacion->fecha_inicial = $request->fecha_inicial;
                  $notificacion->fecha_final = $request->fecha_final;
                  $notificacion->user_id = $request->user_id; // el ID del que genero la notificacion(usuario del supervisor)
                  $notificacion->save();
                  $contador++;
                      }
          
          }
  
          
          return response()->json([
            "success" => true,
            "message" => $contador . " Notificacion(es) creada(s) correctamente."
            
        ]);
  
      }
  }


  
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $data =  Notificacion::findOrFail($id);
            $data->filepathNew = Storage::url($data->filepath);
            $data->sharedfilepathNew = Storage::url($data->sharedfilepath);
            return $data;
        } catch (\Throwable $th) {
            return response()->json(array('success' => false,'messagge'=> 'Registro no encontrado'), 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Notificacion $notificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {   
       
        try {
            $notificacion = Notificacion::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => " Notificacion no encontrada"
                
            ]);
        }
         


         if($notificacion->id_tipo_actividad == 1 || $notificacion->id_tipo_actividad == 3){
            $notificacion->estado = false;
            $notificacion->save();
            return response()->json([
                "success" => true,
                "message" => " Notificacion modificada correctamente."
                
            ]);

         }

         if($notificacion->id_tipo_actividad == 2){
            //store file into document folder
            if ($files = $request->file('file')) {
            $file = $request->file->store('public/documents'); 
            $notificacion->filepath = $file;
            $notificacion->estado=false;
            $notificacion->save();
            }

            return response()->json([
                "success" => true,
                "message" => " Notificacion modificada correctamente."
                
            ]);

         }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {    
        $notificacion = Notificacion::findOrFail($id);
    $notificacion->estado=false;
    
        $notificacion->save();
    return response()->json(array('success' => true, 'messagge'=> 'Registro eliminado correctamente' ), 200);
    } catch (\Throwable $th) {
        return response()->json(array('success' => false,'messagge'=> $th), 404);
    }
    }
}
