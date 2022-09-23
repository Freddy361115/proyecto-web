<?php

namespace App\Http\Controllers;

use App\Models\supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Supervisor::where('estado','=',true)->get(); // Retornando todos los profesores activos.

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


    public function store(Request $request)
    {
        //
        $post = $request->all();    
        $data = new Supervisor;
        $data->nombres = $post['nombres'];
        $data->apellidos = $post['apellidos'];
        $data->fecha_nacimiento = $post['fecha_nacimiento'];
        $data->email = $post['email'];
        $data->direccion = $post['direccion'];
        $data->dpi = $post['dpi']; 
        $data->id_usuario = $post['id_usuario'];
        
    
      
    
        try {
            $data->save();
            return response()->json(array('success' => true, 'messagge'=> null , 'last_insert_id' => $data->id), 200);
    
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('success' => false,'messagge'=> $th, 'last_insert_id' => null), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            return $data =  Supervisor::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(array('success' => false,'messagge'=> 'Registro no encontrado'), 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            //code...
            return $data = supervisor::findOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;    
            return response()->json(array('success' => false,'messagge'=> 'Registro no encontrado'), 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = $request->all();
    $data = Supervisor::findOrFail($id);
    $data->nombres = $post['nombres'];
    $data->apellidos = $post['apellidos'];
    $data->fecha_nacimiento = $post['fecha_nacimiento'];
    $data->email = $post['email'];
    $data->direccion = $post['direccion'];
    $data->dpi = $post['dpi']; 
    $data->id_usuario = $post['id_usuario'];
    try {
        $data->estado = $post['estado'];
    }
    catch(\Throwable $th){
        
    } 
    

try {
    $data->save();
    return response()->json(array('success' => true, 'messagge'=> 'Registro actualizado correctamente' ), 200);

} catch (\Throwable $th) {
    return response()->json(array('success' => false,'messagge'=> $th), 404);
}


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $supervisor = Supervisor::findOrFail($id);
    $supervisor->estado=false;
    try {
        $supervisor->save();
    return response()->json(array('success' => true, 'messagge'=> 'Registro eliminado correctamente' ), 200);
    } catch (\Throwable $th) {
        return response()->json(array('success' => false,'messagge'=> $th), 404);
    }
    }
}
