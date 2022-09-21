@extends('layouts.app', ['activePage' => 'profesor', 'titlePage' => __('Profesores')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
     
      
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Registro de Profesores</h4>
            <p class="card-category"> Listado de profesores actualmente registrados.</p>
          </div>
          <div class="card-body">
          @if (session('status')) 
          <div class="alert alert-success fade show" role="alert">
          <strong>{{ session('status') }}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          @endif


          <div class="row">
                <div class="col-12 text-right">
                  <!-- Trigger the modal with a button -->
                  <button type="button" class="btn btn-succes" data-toggle="modal" data-target="#modalNuevoProfesor"> Agregar Profesor</button>
                  <!-- <a href="#" class="btn btn-sm btn-primary">Agregar profesor</a> -->
                </div>
          </div>
          @if(count($profesor)==0)
                  <h1>NO HAY DATOS EN LA TABLA </h1>
              
          @else
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    #ID
                  </th>
                  <th>
                    Nombre Completo
                  </th>
                  <th>
                    Telefono
                  </th>
                    <th>
                    Correo
                  </th>                  
                  <th class="text-right">
                      Acciones
                    </th>
                </thead>
                <tbody>

                  @foreach($profesor as $profe)
                  
                  <tr>
                  <td> {{$profe->id}} </td>
                  <td> {{$profe->nombres}} {{$profe->apellidos}} </td>
                  <td> {{$profe->telefono}} </td>
                  <td> {{$profe->email}} </td>                  
                  <td class="td-actions text-right">
                     
                  <form method="post" action="{{ route('profesores.destroy', $profe->id)}}">
                        @method('DELETE')
                        @csrf
                        <a href="{{ route('profesores.edit', $profe->id)}}" class="redondo btn btn-info">                        
                        <i class="material-icons">edit</i> 
                        </a>
                        
                        <button type="submit" class="redondo btn btn-danger">
                        <i class="material-icons">close</i>
                        </button>

                        

                        
	
                          </form> 

                           
                  
                 
                  </td>
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
            </div>
            @endif
          </div>
        </div>
      </div>
@include('profesores.modal.create')
@endsection



