@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Solicitar Cita</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/citas') }}">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            {{--<div class="form-group{{ $errors->has('paciente') ? ' has-error' : '' }}">
                                <label for="paciente" class="col-md-4 control-label">Paciente</label>

                                <div class="col-md-6">
                                    <input id="paciente" type="text" class="form-control" name="paciente"
                                           value="{{ $user->paciente->id->nombre." ".$user->paciente->id->apellido." ". $user->paciente->id->cedula }}" autofocus readonly>
                                    @if($errors->has('paciente'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('paciente') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>--}}

                            <div id="especialidadDiv" class="form-group{{ $errors->has('especialidad') ? ' has-error' : '' }}" style="display: none">
                                <label for="especialidad" class="col-md-4 control-label">Especialidad</label>

                                <div class="col-md-6">
                                    <select name="especialidad" id="especialidad" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach($especialidades as $especialidad)
                                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('especialidad'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('especialidad') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group{{ $errors->has('medicos') ? ' has-error' : '' }}">
                                <label for="permisos" class="col-md-4 control-label">Medicos</label>

                                <div class="col-md-6">
                                    @foreach($especialidades->medicos() as $medicos)
                                        <select name="especialidadMedicos" id="especialidadMedicos">
                                            <input class="i-check" type="checkbox" id="permisos" name="permisos[]"
                                                   value="{{ $user->medico->nombre }}"
                                        </select>

                                    @endforeach
                                    @if($errors->has('permisos'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('permisos') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>--}}

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