<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <link rel="icon" href="http://atdigital.com.br/cadastro/images/favicon.ico">

    <!--
    <title>{{ config('app.name', 'Cadastro') }}</title>
    -->
    
    <title>Cadastro</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/painel.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="">
                <img src= "{{ ('http://atdigital.com.br/cadastro/images/logo-grupo.png')}}" alt="Logo GrupoTribuna"/>
            </a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
              <li class="nav-item active">
                <a class="nav-link" href="\ramais/faq">Como utilizar o aparelho? <span class="sr-only">(current)</span></a>
              </li>
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              <li class="nav-item">
                @if (Route::has('register'))
                    <a class="nav-link disabled" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
                @endif
              </li>
            @else
                <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                @if(isset(Auth::user()->nivel))
                    @if((Auth::user()->nivel)==1)
                    <a class="dropdown-item" href="{{ url('/painel_de_controle/admin/') }}">
                        Painel de Controle
                    </a>
                    @elseif((Auth::user()->nivel)==2)
                    <a class="dropdown-item" href="{{ url('/painel_de_controle/usuarios/') }}">
                         Painel de Controle
                    </a>
                    @else
                    <a class="dropdown-item" href="{{ url('/painel_de_controle/clientes/') }}">
                         Painel de Controle
                    </a>
                    @endif
                @endif
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            @endif
            </ul>
          </div>
        </nav>




        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
