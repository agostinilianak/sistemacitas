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
                    <div class="panel-heading">Listado de Pacientes</div>
                    <div class="panel-body">
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    @if(Auth::user()->can('RegistrarPaciente'))
                                        <a href="{{ url('/usuarios/create') }}" class="btn btn-success">
                                            <i class="fa fa-user"></i> Nuevo Paciente
                                        </a>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <form action="{{ url('/pacientes') }}" method="get">
                                        <div class="input-group">
                                            <input type="text" name="buscar" id="buscar" class="form-control"
                                                   placeholder="Buscar por nombre, apellido o cedula"
                                                   value="{{ $buscar }}">
                                            <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i
                                                    class="fa fa-search"></i></button>
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
                                    <th width="10%" colspan="4">Acciones</th>
                                </tr>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->nombre }}</td>
                                        <td>{{ $user->apellido }}</td>
                                        <td>{{ $user->cedula }}</td>
                                        @if(Auth::user()->can('PermisosUsuario'))
                                            <td>
                                                <a href="{{ url('usuarios/'.$user->id.'/permisos') }}"
                                                   class="btn btn-warning">
                                                    <i class="fa fa-id-card"></i>
                                                </a>
                                            </td>
                                        @endif
                                        @if(Auth::user()->can('SolicitarCita'))
                                            <td>
                                                <a href="{{ url('citas/'.$user->id.'/solicitarcita') }}"
                                                   class="btn btn-success">
                                                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        @endif
                                        @if(Auth::user()->can('EditarUsuario'))
                                            <td>
                                                <a href="{{ url('usuarios/'.$user->id.'/edit') }}"
                                                   class="btn btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        @endif
                                        <td>
                                            <button class="btn btn-danger"
                                                    data-action="{{ url('/usuarios/'.$user->id) }}"
                                                    data-name="{{ $user->nombre . " " . $user->apellido }}"
                                                    data-toggle="modal" data-target="#confirm-delete">
                                                <i class="fa fa-trash fa-1x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="7" class="text-center">
                                        {{ $users->appends(['buscar'=>$buscar])->links() }}
                                    </td>
                                </tr>
                            </table>
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
                                @if(Auth::user()->can('EliminarUsuario'))
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
