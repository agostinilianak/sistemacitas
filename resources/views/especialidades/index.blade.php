@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('mensaje'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Info:</strong> {{ session('mensaje') }}.
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"> Listado de Especialidades</div>
                    <div class="panel-body">
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    @if(Auth::user()->can('CrearEspecialidad'))
                                        <a href="{{ url('/especialidades/create') }}" class="btn btn-success">
                                            <i class="fa fa-user"></i> Nueva Especialidad
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th width="10%" colspan="3">Acciones</th>
                            </tr>
                            @foreach($especialidades as $especialidad)
                                <tr>
                                    <td>{{ $especialidad->nombre }}</td>
                                    @if(Auth::user()->can('EditarEspecialidad'))
                                    <td>
                                        <a href="{{ url('especialidades/'.$especialidad->id.'/edit') }}" class="btn btn-primary">
                                            <i class="fa fa-edit" title="Editar Especialidad"></i>
                                        </a>
                                    </td>
                                    @endif
                                    <td>
                                        <button class="btn btn-danger"
                                                data-action="{{ url('$/especialidades/'.$especialidad->id) }}"
                                                data-name="{{ $especialidad->nombre}}"
                                                data-toggle="modal" data-target="#confirm-delete"
                                                title="Editar Especialidad">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-center">
                                    {{ $especialidades->links() }}
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
                        @if(Auth::user()->can('EliminarEspecialidad'))
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
