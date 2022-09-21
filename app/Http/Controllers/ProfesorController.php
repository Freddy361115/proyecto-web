<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Http\Requests\ProfesorRequest;
use Illuminate\Support\Facades\Hash;

class ProfesorController extends Controller
{
    //

    public function index(Profesor $model)
    
    {
        //$data = Profesor::orderBy('id','desc')->paginate(10);

        return view('profesores.index', ['profesor' => $model::where('estado','=', true)->paginate(15)]);

    //return view('profesores.index',compact(['data']));
}


public function create()

    {return view('profesores.create');}


public function store(Request $request)
{  ([   'nombres',
        'apellidos',
        'fecha_nacimiento',
        'dpi' => 'required'
    ]);

    Profesor::create($request->all());
    
    return redirect()->route('profesores.index')->withStatus(__('Profesor Agregado correctamente'));

}
public function show($id)

  { $data =  Profesor::find($id);
   return view('profesores.show',compact(['data']));}


public function edit($id)

   {$data = Profesor::find($id);
   return view('profesores.edit',compact(['data']));}


public function update(Request $request, $id)
{
    $request->validate([
     'nombres' => 'required',
     'apellidos' => 'required',
     'fecha_nacimiento' => 'required',
     'dpi' => 'required']);
}
public function destroy($id)
{
    $profesor = Profesor::findOrFail($id);
    $profesor->estado=false;
    $profesor->save();
    return redirect()->route('profesores.index')->withStatus(__('Eliminado correctamente.'));
    
}
}
