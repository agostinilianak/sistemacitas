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

                            <div class="form-group{{ $errors->has('paciente') ? ' has-error' : '' }}">
                                <label for="paciente" class="col-md-4 control-label">Paciente</label>

                                <div class="col-md-6">
                                    <input id="paciente" type="text" class="form-control" name="paciente"
                                           value="{{ $paciente->nombre." ".$paciente->apellido." ". $paciente->cedula }}" autofocus readonly>
                                    <input type="hidden" id="paciente_id" name="paciente_id" value="{{ $paciente->id }}">
                                    @if($errors->has('paciente'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('paciente') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div id="medico" class="form-group{{ $errors->has('medico') ? ' has-error' : '' }}">
                                <label for="medico" class="col-md-4 control-label">Medico</label>

                                <div class="col-md-6">
                                    <select name="medico" id="medico" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach($medicos as $medico)
                                            <option value="{{ $medico->id }}">{{ $medico->nombre." ". $medico->apellido ." (". $medico->especialidad->nombre . ")"}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('medico'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('medico') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fecha_cita') ? ' has-error' : '' }}">
                                <label for="fecha_cita" class="col-md-4 control-label">Fecha Cita</label>

                                <div class="col-md-6">
                                    <input type="date" name="fecha_cita" id="datepicker" size="12" value="{{ old('fecha_cita') }}" />
                                    @if ($errors->has('fecha_cita'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('fecha_cita') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('hora_cita') ? ' has-error' : '' }}">
                                <label for="hora_cita" class="col-md-4 control-label">Hora Cita</label>

                                <div class="col-md-6">
                                    <input type="time" name="hora_cita" id="timepicker" size="12" value="{{ old('hora_cita') }}" />
                                    @if ($errors->has('hora_cita'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('hora_cita') }}</strong>
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

