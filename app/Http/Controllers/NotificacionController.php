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
        return Notificacion::all();
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

        return response()->json([
            "success" => true,
            "message" => "Notificacion creada correctamente.",
            "file" => $notificacion->id
        ]);
    
        
      }
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

    if($request->id_tipo_actividad == 3)
    {
          
          if($request->has('id_profesor') && !($request->has('id_establecimiento')) ){
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
          }
  
          if($request->has('id_establecimiento')){
              //Regresando todos lo profesores que pertenezcan al establecimiento.
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
                      }
          
          }
  
  
          $notificacion->save();
          return response()->json([
            "success" => true,
            "message" => "File successfully uploaded",
            "file" => $notificacion->id
        ]);
  
      }

      if($request->id_tipo_actividad == 2)
      {
            
            if($request->has('id_profesor') && !($request->has('id_establecimiento')) ){
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
            }
    
            if($request->has('id_establecimiento')){
                //Regresando todos lo profesores que pertenezcan al establecimiento.
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
                        }
            
            }
    
    
            $notificacion->save();
            return response()->json([
              "success" => true,
              "message" => "File successfully uploaded",
              "file" => $notificacion->id
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
        //
        $validator = Validator::make($request->all(), 
        [ 
        'id_tipo_actividad' => 'required',
        
       ]);
       
        if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], 401);                        
         }  

         $notificacion = Notificacion::findOrFail($id);
         if($notificacion->id_tipo_actividad == 1){
            $notificacion->estado = false;
            $notificacion->save();

         }
         if($notificacion->id_tipo_actividad == 3){
            $notificacion->estado = false;
            $notificacion->save();

         }

         if($notificacion->id_tipo_actividad == 2){
            //store file into document folder
            if ($files = $request->file('file')) {
            $file = $request->file->store('public/documents'); 
            $notificacion->filepath = $file;
            $notificacion->estado=false;
            }

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
        //
        $notificacion = Notificacion::findOrFail($id);
    $notificacion->estado=false;
    try {
        $notificacion->save();
    return response()->json(array('success' => true, 'messagge'=> 'Registro eliminado correctamente' ), 200);
    } catch (\Throwable $th) {
        return response()->json(array('success' => false,'messagge'=> $th), 404);
    }
    }
}
