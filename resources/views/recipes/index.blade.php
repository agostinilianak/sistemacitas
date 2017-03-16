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
                    <div class="panel-heading">Listado de Recipes</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Paciente</th>
                                <th>Medico</th>
                                <th>Especialidad</th>
                                <th>Medicinas</th>
                                <th width="10%" colspan="3">Acciones</th>
                            </tr>
                            @foreach($recipes as $recipe)
                                <tr>
                                    <td>{{ $recipe->historiaMedica->cita->paciente->nombre." ".$recipe->historiaMedica->cita->paciente->apellido }}</td>
                                    <td>{{ $recipe->historiaMedica->cita->medico->nombre." ".$recipe->historiaMedica->cita->medico->apellido }}</td>
                                    <td>{{ $recipe->historiaMedica->cita->medico->especialidad->nombre }}</td>
                                    <td>{{ $recipe->medicina[]->nombre  }}</td>
                                    {{--@if(Auth::user()->can('EditarRecipe'))--}}
                                        <td>
                                            <a href="{{ url('recipe/'.$recipe->id.'/edit') }}" class="btn btn-primary"
                                               title="Editar Recipe">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    {{--@endif--}}
                                    <td>
                                        <button class="btn btn-danger"
                                                data-action="{{ url('/recipes/'.$recipe->id) }}"
                                                data-name="{{ $recipe->if }}"
                                                data-toggle="modal" data-target="#confirm-delete"
                                                title="Eliminar Recipe">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="8" class="text-center">
                                    {{---{{ $recipes->links() }}--}}
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
                        @if(Auth::user()->can('EliminarRecipe'))
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
