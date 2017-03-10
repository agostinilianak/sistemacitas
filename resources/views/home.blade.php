@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <strong></strong> {{ session('mensaje') }}.
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenido al Sistema de Citas!!
                    <h3>Recuerde que para pedir la cita debe llamar al Tlf: 0212-5000001</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
