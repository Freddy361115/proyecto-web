<?php

namespace App\Http\Controllers;

use App\Models\establecimiento;
use Illuminate\Http\Request;

class EstablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Establecimiento::where('estado','=',true)->get();
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
    $data = new Establecimiento;
    $data->nombre = $post['nombre'];
    $data->direccion = $post['direccion'];
    $data->telefono = $post['telefono'];
    $data->email = $post['email'];
    $data->codigo_establecimiento = $post['codigo_establecimiento'];    
    $data->id_supervisor = $post['id_supervisor'];  

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
     * @param  \App\Models\establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            return $data =  Establecimiento::where('id_establecimiento',$id)->get();
        } catch (\Throwable $th) {
            return response()->json(array('success' => false,'messagge'=> 'Registro no encontrado'), 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(establecimiento $establecimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = $request->all();
        try {
            Establecimiento::where('id_establecimiento',$id)->update([
                'nombre' => $post['nombre'],
                'direccion' => $post['direccion'],
                'telefono'  => $post['telefono'],
                'email' => $post['email'], 
                'codigo_establecimiento' => $post['codigo_establecimiento'],
                'id_supervisor' => $post['id_supervisor']]);
                try {
                    Establecimiento::where('id_establecimiento',$id)->update (
                        ['estado'=>$post['estado']]
                    );
                    
                }
                catch(\Throwable $th){
                    
                } 
                return response()->json(array('success' => true, 'messagge'=> 'Registro actualizado correctamente' ), 200);
        } catch (\Throwable $th) {
            
            return response()->json(array('success' => false,'messagge'=> $th), 404);
        }
    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        
    try {
        Establecimiento::where('id_establecimiento',$id)
        ->update(['estado'=> false]);
        
    return response()->json(array('success' => true, 'messagge'=> 'Registro eliminado correctamente' ), 200);
    } catch (\Throwable $th) {
        return response()->json(array('success' => false,'messagge'=> $th), 404);
    }
    }
}
