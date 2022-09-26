<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Role::all();
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
        $data = new Role;
        $data->nombre = $post['nombre'];    
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
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            return $data =  Role::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(array('success' => false,'messagge'=> 'Registro no encontrado'), 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            //code...
            return $data = Role::findOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('success' => false,'messagge'=> 'Registro no encontrado'), 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = $request->all();
        $data = Role::findOrFail($id);
        $data->nombre = $post['nombre'];    
        $data->descripcion = $post['descripcion'];

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
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //    

        try {
            $post = Role::findOrFail($id);
            $post->delete();
            return response()->json(array('success' => true, 'messagge'=> 'Registro eliminado correctamente' ), 200);
        
        } catch (\Throwable $th) {
            return response()->json(array('success' => false,'messagge'=> $th), 404);
        }
    }
}
