@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Mis Citas</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ url('/medicos/vermiscitas') }}" method="get">
                                    <div class="input-group">
                                        <input type="text" name="buscarpacientes" id="buscarpacientes"
                                               class="form-control" placeholder="Buscar...">
                                        <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i
                                                    class="fa fa-search"></i></button>
                                    </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Paciente</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th width="10%" colspan="3">Acciones</th>
                                    </tr>
                                    @foreach(Auth::user()->cita as $cita)
                                        <tr>
                                            <td>{{ $cita->paciente->nombre." ".$cita->paciente->apellido." ".$cita->paciente->cedula }}</td>
                                            <td>{{ $cita->fecha_cita }}</td>
                                            <td>{{ $cita->hora_cita }}</td>
                                            <td>{{ ucfirst($cita->status) }}</td>
                                        </tr>
                                        @if(Auth::user()->can('CrearHistoriaMedica'))
                                            <td>
                                                <a href="{{ url('historiasmedicas/create') }}"
                                                   class="btn btn-success">
                                                    <i class="fa fa-database" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        @endif
                                        @if(Auth::user()->can('ActualizarHistoriaMedica'))
                                            <td>
                                                <a href="{{ url('historiasmedicas/'.$hmedica->id.'/actualizar') }}"
                                                   class="btn btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        @endif
                                        <td>
                                            <button class="btn btn-danger"
                                                    data-action="{{ url('/historiasmedicas/'.$hmedica->id) }}"
                                                    data-name="{{ $hmedica->paciente->nombre . " " . $hmedica->paciente->apellido }}"
                                                    data-toggle="modal" data-target="#confirm-delete">
                                                <i class="fa fa-trash fa-1x"></i>
                                            </button>
                                        </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="confirm-delete" tabindex="-1"
                 role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                        </div>
                        <div class="modal-body">
                            <p>¿Seguro que desea eliminar este
                                registro?</p>
                            <p class="nombre"></p>
                        </div>
                        <div class="modal-footer">
                            <form class="form-inline form-delete"
                                  role="form"
                                  method="POST"
                                  action="">
                                {!! method_field('DELETE') !!}
                                {!! csrf_field() !!}
                                <button type="button"
                                        class="btn btn-default"
                                        data-dismiss="modal">Cancelar
                                </button>
                                @if(Auth::user()->can('EliminarHistoriaMedica'))
                                    <button id="delete-btn"
                                            class="btn btn-danger"
                                            title="Eliminar">Eliminar
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
