@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Asignar Permisos Usuario</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/usuarios/'.$user->id.'/asignarpermisos') }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control" name="nombre"
                                           value="{{ $user->nombre or old('nombre') }}" autofocus readonly>
                                    @if($errors->has('nombre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                                <label for="apellido" class="col-md-4 control-label">Apellido</label>

                                <div class="col-md-6">
                                    <input id="apellido" type="text" class="form-control" name="apellido"
                                           value="{{ $user->apellido or old('apellido') }}" autofocus readonly>
                                    @if($errors->has('apellido'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('apellido') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('permisos') ? ' has-error' : '' }}">
                                <label for="permisos" class="col-md-4 control-label">Permisos</label>

                                <div class="col-md-6">
                                    @foreach($permisos as $permiso)
                                        <label class="checkbox-inline">
                                            <input class="i-check" type="checkbox" id="permisos" name="permisos[]"
                                                   value="{{ $permiso->name }}"
                                                   @if($user->hasPermissionTo($permiso->name)) checked @endif>
                                            @if(str_contains($permiso->name,'Modulo'))
                                                <strong>{{ $permiso->name  }}</strong>
                                            @else
                                                {{ $permiso->name  }}
                                            @endif
                                        </label><br>
                                    @endforeach
                                    @if($errors->has('permisos'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('permisos') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection