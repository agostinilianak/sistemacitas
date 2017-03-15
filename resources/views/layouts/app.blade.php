<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SISTEMA CITAS MEDICAS</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap-select.css">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Sistema Citas Medicas
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Iniciar Sesión</a></li>
                        <li><a href="{{ url('/register') }}">Registrarse</a></li>
                    @else
                        @hasrole ('Administrador')
                            <li><a href="{{ url('/citas') }}">Citas</a></li>
                            <li><a href="{{ url('/pacientes') }}">Pacientes</a></li>
                            <li><a href="{{ url('/medicos') }}">Medicos</a></li>
                            <li><a href="{{ url('/usuarios') }}">Usuarios</a></li>
                            <li><a href="{{ url('/especialidades') }}">Especialidades</a></li>
                            <li><a href="{{ url('/medicinas') }}">Medicinas</a></li>
                            <li><a href="{{ url('/historiasmedicas') }}">Historias Medicas</a></li>
                            <li><a href="{{ url('/recipes') }}">Recipes</a></li>
                            <li><a href="{{ url('/roles') }}">Roles</a></li>
                            <li><a href="{{ url('/permisos') }}">Permisos</a></li>
                        @endhasrole
                        @hasrole('Secretaria')
                            <li><a href="{{ url('/citas') }}">Citas</a></li>
                            <li><a href="{{ url('/pacientes') }}">Pacientes</a></li>
                            <li><a href="{{ url('/medicos') }}">Medicos</a></li>
                        @endhasrole
                        @hasrole('Medico')
                            <li><a href="{{ url('/medicos/vermiscitas') }}">Ver mis Citas</a></li>
                            <li><a href="{{ url('/especialidades') }}">Especialidades</a></li>
                            <li><a href="{{ url('/medicinas') }}">Medicinas</a></li>
                            <li><a href="{{ url('/historiasmedicas') }}">Historias Medicas</a></li>
                            <li><a href="{{ url('/recipes') }}">Recipes</a></li>
                        @endhasrole
                        @hasrole('Farmaceuta')
                            <li><a href="{{ url('/medicinas') }}">Medicinas</a></li>
                            <li><a href="{{ url('/recipes') }}">Recipes</a></li>
                        @endhasrole
                        @hasrole('Paciente')
                            <li><a href="{{ url('/vermiscitas') }}">Mis Citas</a></li>
                        @endhasrole
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->nombre . " " . Auth::user()->apellido}} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Salir
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
<script src="/js/bootstrap-select.js"></script>
<script type="application/javascript">
    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.form-delete').attr('action', $(e.relatedTarget).data('action'));
        $(this).find('.nombre').text($(e.relatedTarget).data('name'));
    });
</script>
<script>
    $('#role').on('change', function (e){
        if ($(e.target).val()=='Medico'){
            $('#especialidadDiv').show();
        }else {
            $('#especialidadDiv').hide();
        }
    }).trigger('change');
</script>

</body>
</html>
