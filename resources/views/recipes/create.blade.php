@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Recipe</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/recipes') }}">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="medico" class="col-md-4 control-label">Medico</label>
                                <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $hmedica->cita->medico->nombre. " ".
                                $hmedica->cita->medico->apellido. " (".$hmedica->cita->medico->especialidad->nombre.")" }}" readonly>
                                </div>
                                <input type="hidden" name="historiamedica_id" id="historiamedica_id" value="{{$hmedica->id}}">
                            </div>

                            <div class="form-group">
                                <label for="paciente" class="col-md-4 control-label">Paciente</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $hmedica->cita->paciente->nombre. " ".
                                    $hmedica->cita->paciente->apellido. " C.I.:".$hmedica->cita->paciente->cedula }}" readonly>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('medicina') ? ' has-error' : '' }}">
                                <label for="medicina" class="col-md-4 control-label">Medicinas</label>
                                <div class="col-md-6">
                                    <select name="medicina[]" id="medicina" class="form-control selectpicker" multiple
                                            data-max-options="5">
                                        <option value="">Seleccione</option>
                                        @foreach($medicinas as $medicina)
                                            <option value="{{ $medicina->id }}" @if(old('medicina')==$medicina->id) selected @endif>
                                                {{ $medicina->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($errors->has('medicina'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('medicina') }}</strong>
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
