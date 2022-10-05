<?php

namespace App\Http\Controllers;

use App\Models\TipoNotificacion;
use Illuminate\Http\Request;

class TipoNotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return TipoNotificacion::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

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
        $data = new TipoNotificacion;            
        $data->descripcion = $post['descripcion'];

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
     * @param  \App\Models\TipoNotificacion  $tipoNotificacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            return $data =  TipoNotificacion::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(array('success' => false,'messagge'=> 'Registro no encontrado'), 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoNotificacion  $tipoNotificacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            //code...
            return $data = TipoNotifiacion::findOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('success' => false,'messagge'=> 'Registro no encontrado'), 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoNotificacion  $tipoNotificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = $request->all();
        $data = TipoNotificacion::findOrFail($id);            
        $data->descripcion = $post['descripcion'];
        $data->estado = $post['estado'];

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
     * @param  \App\Models\TipoNotificacion  $tipoNotificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $post = TipoNotificacion::findOrFail($id);
            $post->estado=false;
            $post->save();
            return response()->json(array('success' => true, 'messagge'=> 'Registro eliminado correctamente' ), 200);
        
        } catch (\Throwable $th) {
            return response()->json(array('success' => false,'messagge'=> $th), 404);
        }
        
    }
}
