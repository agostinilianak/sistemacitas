@extends('layouts.app')

@section('content')
    <div class="container">
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
                                            <td>{{ $cita->paciente->nombre." ".$cita->paciente->apellido." ".$cita->paciente->cedula }}</td>
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
                                                @if(Auth::user()->can('EditarHistoriaMedica') && $cita->historiaMedica)
                                                    <a href="{{ url('historiasmedicas/'.$cita->historiaMedica->id.'/edit') }}"
                                                       class="btn btn-primary" title="Editar Historia Medica">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="fa fa-edit" title="Editar Historia Medica"></i>
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::user()->can('CrearRecipe') && $cita->historiaMedica)
                                                    <a href="{{ url('recipes/create') }}"
                                                       class="btn btn-primary" title="Crear Recipe">
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
