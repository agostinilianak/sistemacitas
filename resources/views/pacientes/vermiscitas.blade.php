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
                                        <th>Medico</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Status</th>
                                    </tr>
                                    @foreach(Auth::user()->cita as $cita)
                                        <tr>
                                            <td>{{ $cita->medico->nombre." ".$cita->medico->apellido." ".$cita->medico->especialidad->nombre }}</td>
                                            <td>{{ $cita->fecha_cita }}</td>
                                            <td>{{ $cita->hora_cita }}</td>
                                            <td>{{ ucfirst($cita->status) }}</td>
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
    </div>
    </div>
@endsection