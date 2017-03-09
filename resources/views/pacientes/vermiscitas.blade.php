@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Mis Citas</div>

                    <div class="panel-body">
                        <div class="row">
                            @foreach($citas as $cita)
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <div>
                                            <li>{{ $cita->especialidad }}</li>
                                            <li>{{ $cita->medico }}</li>
                                            <li>{{ $cita->fecha_cita}}</li>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection