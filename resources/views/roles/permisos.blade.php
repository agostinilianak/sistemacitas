@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Role</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/roles/'.$role->id.'/permisos') }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ $role->name or old('name') }}" autofocus readonly>
                                    @if($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
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
                                                   @if($role->hasPermissionTo($permiso->name)) checked @endif>

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