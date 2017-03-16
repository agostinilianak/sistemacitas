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
                    <div class="panel-heading">Listado de Historias Medicas</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ url('/historiasmedicas') }}" method="get">
                                    <div class="input-group">
                                        <input type="text" name="buscar" id="buscar" class="form-control"
                                               placeholder="Buscar por nombre, apellido o cedula" value="{{ $buscar }}">
                                        <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cedula</th>
                                <th>Medico</th>
                                <th>Especialidad</th>
                                <th>Fecha Cita</th>
                                <th>Hora Cita</th>
                                <th width="10%" colspan="3">Acciones</th>
                            </tr>
                            @foreach($hmedicas as $hmedica)
                                <tr>
                                    <td>{{ $hmedica->cita->paciente->nombre }}</td>
                                    <td>{{ $hmedica->cita->paciente->apellido }}</td>
                                    <td>{{ $hmedica->cita->paciente->cedula }}</td>
                                    <td>{{ $hmedica->cita->medico->nombre." ".$hmedica->cita->medico->apellido  }}</td>
                                    <td>{{ $hmedica->cita->medico->especialidad->nombre }}</td>
                                    <td>{{ $hmedica->cita->fecha_cita }}</td>
                                    <td>{{ $hmedica->cita->hora_cita }}</td>
                                    <td>
                                        @if(Auth::user()->can('VerHistoriaMedica'))
                                            <a href="{{ url('historiasmedicas/'.$hmedica->id.'/verhistoriamedica') }}"
                                               class="btn btn-primary" title="Ver Historia Medica">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <button class="btn btn-primary" disabled>
                                                <i class="fa fa-search-plus" aria-hidden="true" title="Ver Historia Medica"></i>
                                            </button>
                                        @endif
                                    </td>

                                    <td>
                                        {{--@if(Auth::user()->can('EditarHistoriaMedica'))--}}
                                            <a href="{{ url('historiasmedicas/'.$hmedica->id.'/edit') }}"
                                               class="btn btn-primary" title="Editar Historia Medica">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {{--@else
                                            <button class="btn btn-primary" disabled>
                                                <i class="fa fa-edit" title="Editar Historia Medica"></i>
                                            </button>
                                        @endif--}}
                                    </td>
                                    <td>
                                        <button class="btn btn-danger"
                                                data-action="{{ url('/historiasmedicas/'.$hmedica->id) }}"
                                                data-name="{{ $hmedica->cita->paciente->nombre ." ". $hmedica->cita->paciente->apellido.
                                                " C.I.: " . $hmedica->cita->paciente->cedula." ".$hmedica->cita->fecha_cita  }}"
                                                data-toggle="modal" data-target="#confirm-delete" title="Eliminar Historia Medica">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="10" class="text-center">
                                  {{--  {{ $hmedicas->appends(['buscar'=>$buscar])->links() }}--}}
                                </td>
                            </tr>
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
@endsection
