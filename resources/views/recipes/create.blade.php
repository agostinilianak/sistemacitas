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

                            <div class="form-group{{ $errors->has('historiamedica_id') ? ' has-error' : '' }}">
                                <label for="" class="col-md-4 control-label">Paciente</label>
                                <div class="col-md-6">
                                    <input id="" type="text" class="form-control" name=""
                                           value="{{ $hmedica->cita->paciente->nombre." ".$hmedica->cita->paciente->apellido." ". $hmedica->cita->paciente->cedula }}"
                                           autofocus readonly>
                                    <input type="hidden" id="historiamedica_id" name="historiamedica_id"
                                           value="{{ $hmedica->id }}">
                                    @if($errors->has('historiamedica_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('historiamedica_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('medicina_id') ? ' has-error' : '' }}">
                                <label for="medicina_id" class="col-md-4 control-label">Medicinas</label>
                                <div class="col-md-6">
                                    <select name="medicina_id[]" id="medicina_id[]" class="selectpicker" multiple
                                            data-max-options="3">
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
