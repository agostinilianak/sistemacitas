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
                    <div class="panel-heading">Listado de Citas</div>
                    <div class="panel-body">

                        <table class="table table-bordered">
                            <tr>
                                <th>Paciente</th>
                                <th>Medico</th>
                                <th>Especialidad</th>
                                <th>Fecha</th>
                                <th>Status</th>
                                <th width="10%" colspan="3">Acciones</th>
                            </tr>
                            @foreach($citas as $cita)
                                <tr>
                                    <td>{{ $user->paciente->nombre. " " . $user->paciente->apellido }}</td>
                                    <td>{{ $user->medico->nombre ." ". $user->medico->apellido }}</td>
                                    <td>{{ $user->especialidad->nombre }}</td>
                                    <td>{{ $cita->fecha_cita }}</td>
                                    <td>{{ $cita->status }}</td>
                                    @if(Auth::user()->can('EditarCita'))
                                    <td>
                                            <a href="{{ url('citas/'.$cita->id.'/edit') }}"
                                               class="btn btn-warning">
                                                <i class="fa fa-id-card"></i>
                                            </a>
                                    </td>
                                    @endif
                                    @if(Auth::user()->can('CambiarStatusCita'))
                                        <td>
                                            <a href="{{ url('citas/'.$cita->id.'/edit') }}"
                                               class="btn btn-warning">
                                                <i class="fa fa-id-card"></i>
                                            </a>
                                        </td>
                                    @endif
                                    <td>
                                        <button class="btn btn-danger"
                                                data-action="{{ url('/citas/'.$cita->id) }}"
                                                data-name="{{ $cita->paciente . " " . $cita->fecha_cita  }}"
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
                        @if(Auth::user()->can('EliminarCita'))
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
@endsection