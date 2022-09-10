<form method="post" action="{{ route('profesores.store') }}" enctype="multipart/form-data">
@csrf
<div class="modal" tabindex="-1" role="dialog" id="modalNuevoProfesor">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nuevo Profesor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card-body">
            
            
            <div class="bmd-form-group{{ $errors->has('dpi') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="number" name="dpi" class="form-control" placeholder="{{ __('Escriba el numero de DPI') }}" value="{{ old('dpi') }}" required>
              </div>
              @if ($errors->has('dpi'))
                <div id="name-error" class="error text-danger pl-3" for="dpi" style="display: block;">
                  <strong>{{ $errors->first('dpi') }}</strong>
                </div>
              @endif
            </div>


            <div class="bmd-form-group{{ $errors->has('nombres') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="text" name="nombres" class="form-control" placeholder="{{ __('Escriba los nombres') }}" value="{{ old('nombres') }}" required>
              </div>
              @if ($errors->has('nombres'))
                <div id="name-error" class="error text-danger pl-3" for="nombres" style="display: block;">
                  <strong>{{ $errors->first('nombres') }}</strong>
                </div>
              @endif
            </div>

            <div class="bmd-form-group{{ $errors->has('apellidos') ? ' has-danger' : '' }} mt-3" >
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="text" name="apellidos" class="form-control" placeholder="{{ __('Escriba los apellidos') }}" value="{{ old('apellidos') }}" required>
              </div>
              @if ($errors->has('apellidos'))
                <div id="name-error" class="error text-danger pl-3" for="apellidos" style="display: block;">
                  <strong>{{ $errors->first('apellidos') }}</strong>
                </div>
              @endif
            </div>

            <div class="bmd-form-group{{ $errors->has('fecha_nacimiento') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="date" name="fecha_nacimiento" class="form-control" placeholder="{{ __('Seleccione fecha nacimiento') }}" value="{{ old('fecha_nacimiento') }}" required>
              </div>
              @if ($errors->has('fecha_nacimiento'))
                <div id="name-error" class="error text-danger pl-3" for="fecha_nacimiento" style="display: block;">
                  <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                </div>
              @endif
            </div>

            <div class="bmd-form-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="phone" name="telefono" class="form-control" placeholder="{{ __('Ingrese el numero de telefono') }}" value="{{ old('telefono') }}">
              </div>
              @if ($errors->has('telefono'))
                <div id="name-error" class="error text-danger pl-3" for="telefono" style="display: block;">
                  <strong>{{ $errors->first('telefono') }}</strong>
                </div>
              @endif
            </div>



            <div class="bmd-form-group{{ $errors->has('direccion') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="text" name="direccion" class="form-control" placeholder="{{ __('Escriba la direccion') }}" value="{{ old('direccion') }}" required>
              </div>
              @if ($errors->has('direccion'))
                <div id="name-error" class="error text-danger pl-3" for="direccion" style="display: block;">
                  <strong>{{ $errors->first('direccion') }}</strong>
                </div>
              @endif
            </div>
            
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="{{ __('Escriba la direccion de correo electronico') }}" value="{{ old('email') }}">
              </div>
              @if ($errors->has('email'))
                <div id="name-error" class="error text-danger pl-3" for="direccion" style="display: block;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>
                
                
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary">Guardar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</form>