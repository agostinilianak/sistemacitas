@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Ver Historia Medica</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/historiasmedicas/'.$hmedica->id) }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('paciente') ? ' has-error' : '' }}">
                                <label for="paciente" class="col-md-4 control-label">Paciente</label>
                                <div class="col-md-6">
                                    <input id="paciente" type="text" class="form-control" name="paciente"
                                           value="{{ $hmedica->cita->paciente->nombre." ".$hmedica->cita->paciente->apellido." ". $hmedica->cita->paciente->cedula }}"
                                           autofocus readonly>
                                    <input id="paciente" type="text" class="form-control" name="paciente"
                                           value="{{ $hmedica->cita->medico->nombre." ".$hmedica->cita->medico->apellido." (".$hmedica->cita->especialidad->nombre.")"}}"
                                           autofocus readonly>
                                    <input type="hidden" id="cita_id" name="cita_id" value="{{ $hmedica->cita->id }}">
                                    <input type="hidden" id="paciente_id" name="paciente_id"
                                           value="{{ $hmedica->cita->paciente->id }}">
                                    <input type="hidden" id="medico_id" name="medico_id"
                                           value="{{ $hmedica->cita->medico->id }}">
                                    <input type="hidden" id="especialidad_id" name="especialidad_id"
                                           value="{{ $hmedica->cita->especialidad->id }}">
                                    @if($errors->has('paciente'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('paciente') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('motivoconsulta') ? ' has-error' : '' }}">
                                <label for="motivoconsulta" class="col-md-4 control-label">Motivo de la Consulta</label>
                                <div class="col-md-6">
                                    <textarea name="motivoconsulta" id="motivoconsulta" cols="50"
                                              rows="2" readonly>{{ $hmedica->motivoconsulta or old('motivoconsulta') }}</textarea>
                                    @if($errors->has('motivoconsulta'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('motivoconsulta') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('examenfisico') ? ' has-error' : '' }}">
                                <label for="examenfisico" class="col-md-4 control-label">Examen Fisico</label>
                                <div class="col-md-6">
                                    <textarea name="examenfisico" id="examenfisico" cols="50"
                                              rows="5" readonly>{{ $hmedica->examenfisico or old('examenfisico') }}</textarea>
                                    @if($errors->has('examenfisico'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('examenfisico') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('indicacionesHM') ? ' has-error' : '' }}">
                                <label for="indicacionesHM" class="col-md-4 control-label">Indicaciones Historia
                                    Medica</label>
                                <div class="col-md-6">
                                    <textarea name="indicacionesHM" id="indicacionesHM" cols="50"
                                              rows="5" readonly>{{ $hmedica->indicacionesHM or old('indicacionesHM') }}</textarea>
                                    @if($errors->has('indicacionesHM'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('indicacionesHM') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" class="back-button btn btn-success">
                                        Regresar
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