<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Grado::where('estado','=',true)->get(); // Retornando todos los grados activos.
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
        $post = $request->all();    
        $data = new Grado;
        $data->nombre = $post['nombre'];        
        $data->seccion = $post['seccion'];  
        $data->id_establecimiento = $post['id_establecimiento'];
        $data->id_profesor = $post['id_profesor'];        
    
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
     * @param  \App\Models\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            return $data =  Grado::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(array('success' => false,'messagge'=> 'Registro no encontrado'), 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grado  $grado
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
     * @param  \App\Models\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $post = $request->all();
        $data = Grado::findOrFail($id);
        $data->nombre = $post['nombre'];
        $data->seccion = $post['seccion'];
        $data->id_establecimiento = $post['id_establecimiento'];
        $data->id_profesor = $post['id_profesor'];
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
     * @param  \App\Models\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $grado = Grado::findOrFail($id);
    $grado->estado=false;
    try {
        $grado->save();
    return response()->json(array('success' => true, 'messagge'=> 'Registro eliminado correctamente' ), 200);
    } catch (\Throwable $th) {
        return response()->json(array('success' => false,'messagge'=> $th), 404);
    }
    }
}
