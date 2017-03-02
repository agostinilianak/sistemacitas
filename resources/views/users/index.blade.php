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
                    <div class="panel-heading">Listado</div>

                    <div class="panel-body">
                        <a href="{{ url('/usuarios/create') }}" class="btn btn-success">
                            <i class="fa fa-user"></i> Nuevo
                        </a>

                        <table class="table table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Telefono</th>
                                <th>Celular</th>
                                <th>Rol</th>
                                <th width="10%" colspan="3">Acciones</th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->nombre }}</td>
                                    <td>{{ $user->apellido }}</td>
                                    <td>{{ $user->telefono }}</td>
                                    <td>{{ $user->celular }}</td>
                                    <td>{{ $user->roles[0]->name }}</td>
                                    <td>
                                        <a href="{{ url('usuarios/'.$user->id.'/permisos') }}"
                                           class="btn btn-warning">
                                            <i class="fa fa-id-card"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('usuarios/'.$user->id.'/edit') }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    {{--<td>
                                        @if(Auth::user()->roles[0]->hasPermissionTo('PermisosUsuario') or Auth::user()->can('PermisosUsuario'))

                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->roles[0]->hasPermissionTo('EditarUsuario') or Auth::user()->can('EditarUsuario'))

                                        @endif
                                    </td>--}}
                                    <td>
                                        <button class="btn btn-danger"
                                                data-action="{{ url('/usuarios/'.$user->id) }}"
                                                data-name="{{ $user->nombre . " " . $user->apellido . " C.I.: " . $user->cedula  }}"
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
                        <button id="delete-btn"
                                class="btn btn-danger"
                                title="Eliminar">Eliminar
                        </button>
                        {{--@if(Auth::user()->roles[0]->hasPermissionTo('EliminarUsuario') or Auth::user()->can('EliminarUsuario'))

                        @endif--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
