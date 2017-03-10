@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/citas') }}">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('paciente') ? ' has-error' : '' }}">
                                <label for="paciente" class="col-md-4 control-label">Paciente</label>

                                <div class="col-md-6">
                                    <input id="paciente" type="text" class="form-control" name="paciente"
                                           value="{{ $paciente->nombre." ".$paciente->apellido." ". $paciente->cedula or old('paciente') }}" autofocus readonly>
                                    <input type="hidden" id="paciente_id" name="paciente_id" value="{{ $paciente->id }}">
                                    @if($errors->has('paciente'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('paciente') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div id="medicos" class="form-group{{ $errors->has('medicos') ? ' has-error' : '' }}">
                                <label for="medicos" class="col-md-4 control-label">Medicos</label>

                                <div class="col-md-6">
                                    <select name="medicos" id="medicos" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach($medicos as $medico)
                                            <option value="{{ $medico->id or old('medicos')}}">{{ $medico->nombre." ". $medico->apellido ." (". $medico->especialidad->nombre . ")"}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('medicos'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('medicos') }}</strong>
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

                            <div class="form-group {{$errors->has('status') ? 'has-error' : ''}}">
                                <label for="status" class="col-md-4 control-label">Status</label>
                                <div class="col-md-6">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Seleccione: </option>
                                        <option value="solicitadas" @if(old('status')=='solicitadas') selected @endif>Solicitada</option>
                                        <option value="concluidas" @if(old('status')=='concluidas') selected @endif>Concluida</option>
                                        <option value="canceladas" @if(old('status')=='canceladas') selected @endif>Cancelada</option>
                                    </select>
                                </div>
                                @if($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group {{$errors->has('observaciones') ? 'has-error' : ''}}">
                                <label for="observaciones" class="col-md-4 control-label">Observaciones</label>
                                <div class="col-md-6">
                                    <input type="text" name="text" id="observaciones" value="{{ old('observaciones') }}" />
                                </div>
                                @if($errors->has('observaciones'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('observaciones') }}</strong>
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