@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Cambiar Status Cita</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/citas/'.$cita->id) }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('paciente') ? ' has-error' : '' }}">
                                <label for="paciente" class="col-md-4 control-label">Paciente</label>

                                <div class="col-md-6">
                                    <input id="paciente" type="text" class="form-control" name="paciente"
                                           value="{{ $paciente->nombre." ".$paciente->apellido." ". $paciente->cedula }}"
                                           autofocus readonly>
                                    <input type="hidden" id="paciente_id" name="paciente_id"
                                           value="{{ $paciente->id }}">
                                    @if($errors->has('paciente'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('paciente') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div id="medico" class="form-group{{ $errors->has('medico') ? ' has-error' : '' }}">
                                <label for="medico" class="col-md-4 control-label">Medicos</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $cita->medico->nombre." ". $cita->medico->apellido ." (". $cita->medico->especialidad->nombre . ")"}}"
                                           autofocus readonly>
                                    <input type="hidden" id="medico" name="medico" value="{{ $medico->id }}">
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
                                    <input type="date" name="fecha_cita" id="datepicker" size="12"
                                           value="{{isset($old)? $old->input('fecha_cita') : $cita->fecha_cita}}"  readonly/>
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
                                    <input type="time" name="hora_cita" id="timepicker" size="12"
                                           value="{{isset($old)? $old->input('hora_cita') : $cita->hora_cita}}" readonly/>
                                    @if ($errors->has('hora_cita'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('hora_cita') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('status') ? 'has-error' : ''}}">
                                <label for="status" class="col-md-4 control-label">Status</label>
                                <div class="col-md-6">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Seleccione:</option>
                                        <option value="solicitada" @if(old('status')=='solicitada') selected @endif>
                                            Solicitada
                                        </option>
                                        <option value="concluida" @if(old('status')=='concluida') selected @endif>
                                            Concluida
                                        </option>
                                        <option value="cancelada" @if(old('status')=='cancelada') selected @endif>
                                            Cancelada
                                        </option>
                                    </select>
                                </div>
                                @if($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
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