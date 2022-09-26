<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Input;
use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfesorRequest;
use DateTime;

class ProfesorController extends Controller
{
    //

    public function index(Profesor $model)
    
    {
        //$data = Profesor::orderBy('id','desc')->paginate(10);
        return Profesor::where('estado','=',true)->get(); // Retornando todos los profesores activos.

        //return view('profesores.index', ['profesor' => $model::where('estado','=', true)->paginate(15)]);

    //return view('profesores.index',compact(['data']));
}


public function create()

    {return view('profesores.create');}


public function store(Request $request)
{   $dataUser = new User;
    $post = $request->all();    
    $data = new Profesor;
    try {
        /* DATOS PARA CREAR USUARIO */
    $dataUser->email = $post['email'];
    $dataUser->name=$post['nombre_usuario'];
    $dataUser->password = Hash::make($post['password']);
    $dataUser->save();
    $dataUser->roles()->attach(2); // Agregando rol de profesor al usuario creado.
    } catch (\Throwable $th) {
        //throw $th;
        return response()->json(array('success' => false,'messagge'=> $th, 'last_insert_id' => null), 400);
    }
    
    

    
    $data->nombres = $post['nombres'];
    $data->apellidos = $post['apellidos'];
    $data->fecha_nacimiento = $post['fecha_nacimiento'];
    $data->telefono = $post['telefono'];
    $data->email = $post['email'];
    $data->dpi = $post['dpi'];
    $data->direccion = $post['direccion'];    
    $data->id_usuario = $dataUser->id;

    try {
        $data->save();
        return response()->json(array('success' => true, 'messagge'=> null , 'last_insert_id' => $data->id), 200);

    } catch (\Throwable $th) {
        //throw $th;
        return response()->json(array('success' => false,'messagge'=> $th, 'last_insert_id' => null), 400);
    }
    
    
    //return redirect()->route('profesores.index')->withStatus(__('Profesor Agregado correctamente'));

}
public function show($id)

  { 
    try {
        return $data =  Profesor::findOrFail($id);
    } catch (\Throwable $th) {
        return response()->json(array('success' => false,'messagge'=> 'Registro no encontrado'), 404);
    }
    
   }


public function edit($id)

   { 
    try {
        //code...
        return $data = Profesor::findOrFail($id);
    } catch (\Throwable $th) {
        //throw $th;
        return response()->json(array('success' => false,'messagge'=> 'Registro no encontrado'), 404);
    }
    

   //return view('profesores.edit',compact(['data']));
}


public function update(Request $request, $id)
{
    date_default_timezone_set('America/Guatemala');
    $horaActual = new \DateTime('now');
    $post = $request->all();
    $data = Profesor::findOrFail($id);
    $data->nombres = $post['nombres'];
    $data->apellidos = $post['apellidos'];
    $data->fecha_nacimiento = $post['fecha_nacimiento'];
    $data->telefono = $post['telefono'];
    $data->email = $post['email'];
    $data->dpi = $post['dpi'];
    $data->direccion = $post['direccion'];
    $data->id_usuario = $post['id_usuario'];
    


    $data->updated_at = $horaActual->format("Y-m-d H:i:s");
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
public function destroy($id)
{
    $profesor = Profesor::findOrFail($id);
    $profesor->estado=false;
    try {
        $profesor->save();
    return response()->json(array('success' => true, 'messagge'=> 'Registro eliminado correctamente' ), 200);
    } catch (\Throwable $th) {
        return response()->json(array('success' => false,'messagge'=> $th), 404);
    }
    
    
    
}
}
