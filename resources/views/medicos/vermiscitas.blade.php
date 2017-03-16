@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('mensaje'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <strong>Info:</strong> {{ session('mensaje') }}.
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Mis Citas</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Paciente</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th width="10%" colspan="4">Acciones</th>
                                    </tr>
                                    @foreach($citas as $cita)
                                        <tr>
                                            <td>{{ $cita->paciente->nombre." ".$cita->paciente->apellido." C.I.:".$cita->paciente->cedula }}</td>
                                            <td>{{ $cita->fecha_cita }}</td>
                                            <td>{{ $cita->hora_cita }}</td>
                                            <td>
                                            @if(Auth::user()->can('CrearHistoriaMedica'))
                                                    <a href="{{ url('historiasmedicas/create/'.$cita->id) }}"
                                                       class="btn btn-success" title="Crear Historia Medica">
                                                        <i class="fa fa-database" aria-hidden="true"></i>
                                                    </a>
                                            @endif
                                            </td>
                                            <td>
                                                @if(Auth::user()->can('CrearRecipe') && $cita->historiaMedica && !$cita->historiaMedica->recipe)
                                                    <a href="{{ url('recipes/create/'.$cita->historiaMedica->id) }}" class="btn btn-info" title="Crear Recipe">
                                                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                                    </a>
                                                    @else
                                                        <button class="btn btn-primary" disabled>
                                                            <i class="fa fa-plus-square-o" aria-hidden="true" title="Crear Recipe"></i>
                                                        </button>
                                                @endif
                                            </td>
                                            @if(Auth::user()->can('CambiarStatusCita'))
                                                <td>
                                                    <a href="{{ url('citas/'.$cita->id.'/cambiarstatuscita') }}"
                                                       class="btn btn-danger" title="Cambiar Status Cita">
                                                        <i class="fa fa-id-card"></i>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
