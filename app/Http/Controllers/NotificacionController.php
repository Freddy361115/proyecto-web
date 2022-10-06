<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;

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
        return Notificacion::where("estado","=",true)->get();
        
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
      foreach ($profesores as $profesor) {
        $notificacion = new Notificacion();
        $notificacion->id_tipo_actividad = $request->id_tipo_actividad;        
        $notificacion->titulo_actividad = $request->titulo_actividad;
        $notificacion->descripcion = $request->descripcion;
        $notificacion->fecha_inicial = $request->fecha_inicial;
        $notificacion->fecha_final = $request->fecha_final;
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
          
          if($request->has('id_profesor') && !($request->has('id_establecimiento')) ){
          $id=$request->id_profesor;
          $data =  Profesor::findOrFail($id);
          $notificacion = new Notificacion();
          $notificacion->id_profesor = $data->id; 
          $notificacion->id_establecimiento = $data->id_establecimiento;        
          $notificacion->id_tipo_actividad = $request->id_tipo_actividad;        
          $notificacion->titulo_actividad = $request->titulo_actividad;
          $notificacion->descripcion = $request->descripcion;
          $notificacion->fecha_inicial = $request->fecha_inicial;
          $notificacion->fecha_final = $request->fecha_final;
          $notificacion->user_id = $request->user_id; // el ID del que genero la notificacion(usuario del supervisor)
          $notificacion->save();
          $contador++;
          
          }
  
          if($request->has('id_establecimiento')){
              //Regresando todos lo profesores que pertenezcan al establecimiento.
              $id=$request->id_establecimiento;
              $profesores =  Profesor::where('id_establecimiento',$id)->get();
              foreach ($profesores as $profesor) {
                  $notificacion = new Notificacion();
                  $notificacion->id_profesor = $profesor->id; 
                  $notificacion->id_establecimiento = $profesor->id_establecimiento;        
                  $notificacion->id_tipo_actividad = $request->id_tipo_actividad;        
                  $notificacion->titulo_actividad = $request->titulo_actividad;
                  $notificacion->descripcion = $request->descripcion;
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
            return $data =  Notificacion::findOrFail($id);
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
