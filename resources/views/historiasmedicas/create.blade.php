@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Historia Medica</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/historiasmedicas') }}">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('paciente') ? ' has-error' : '' }}">
                                <label for="paciente" class="col-md-4 control-label">Paciente</label>
                                <div class="col-md-6">
                                    <input id="paciente" type="text" class="form-control" name="paciente"
                                           value="{{ $cita->paciente->nombre." ".$cita->paciente->apellido." ". $cita->paciente->cedula }}"
                                           autofocus readonly>
                                    <input id="paciente" type="text" class="form-control" name="paciente"
                                           value="{{ $cita->medico->nombre." ".$cita->medico->apellido." (".$cita->especialidad->nombre.")"}}"
                                           autofocus readonly>
                                    <input type="hidden" id="cita_id" name="cita_id" value="{{ $cita->id }}">
                                    <input type="hidden" id="paciente_id" name="paciente_id"
                                           value="{{ $cita->paciente->id }}">
                                    <input type="hidden" id="medico_id" name="medico_id"
                                           value="{{ $cita->medico->id }}">
                                    <input type="hidden" id="especialidad_id" name="especialidad_id"
                                           value="{{ $cita->especialidad->id }}">
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
                                              rows="2">{{ old('motivoconsulta') }}</textarea>
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
                                              rows="5">{{ old('examenfisico') }}</textarea>
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
                                              rows="5">{{ old('indicacionesHM') }}</textarea>
                                    @if($errors->has('indicacionesHM'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('indicacionesHM') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if(Auth::user()->can('CrearRecipe'))
                                <div class="form-group{{ $errors->has('medicina_id') ? ' has-error' : '' }}">
                                    <label for="medicina_id" class="col-md-4 control-label">Medicinas</label>
                                    <div class="col-md-6">
                                        <select name="medicina_id[]" id="medicina_id[]" class="selectpicker" multiple data-max-options="3">
                                            <option value="">Seleccione</option>
                                            @foreach($medicinas as $medicina)
                                                <option value="{{ $medicina->id }}">{{ $medicina->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($errors->has('medicina_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('medicina_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('observaciones') ? ' has-error' : '' }}">
                                    <label for="observaciones" class="col-md-4 control-label">Observaciones</label>
                                    <div class="col-md-6">
                                        <textarea name="observaciones" id="observaciones" cols="50"
                                                  rows="5">{{ old('observaciones') }}</textarea>
                                        @if($errors->has('observaciones'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('observaciones') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            @endif

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
