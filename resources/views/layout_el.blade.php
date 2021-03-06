<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Accueil</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ secure_asset('../resources/css/accueil.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>

  <style>
    canvas {
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
    }
  </style>

</head>

<body>
  <div class="container">
    <div class="row fond_bienvenue w" >
      <div class="col-lg-4 l">
        Bienvenue {{ $prenom }} {{ $nom }}
      </div>
        <p style="display:none" id="idUtilisateur">{{ $idUtilisateur }}</p>
      <div class="col-lg-4 m">
        <b>Visualisation de votre progression</b>
      </div>
      <div class="col-lg-4 r">
          @if (Request::is('eleve'))
              <a id="print" href="">Imprimer</a>
          @elseif (Request::is('eleve/radar'))
              <a id="print" href="">Imprimer</a>
          @else
              <a href="{{ url('/impressionLivret/' . $idUtilisateur.'/l') }}" target="_blank">Imprimer</a>
          @endif
      </div>
    </div>
  </div>
  <div class="container nw">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item {{ Request::is('eleve') ? 'active' : '' }}">
            <a class="nav-link" href="{{url('/eleve')}}">Histogramme</a>
          </li>
          <li class="nav-item {{ Request::is('eleve/radar') ? 'active' : '' }}">
            <a class="nav-link" href="{{url('/eleve/radar')}}">Radar</a>
          </li>
          <li class="nav-item {{ Request::is('eleve/livret') ? 'active' : '' }}">
            <a class="nav-link" href="{{url('/eleve/livret')}}">Livret <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item">
            <a id="deconnexion" class="nav-link" href="{{url('/')}}" style="color: #d13434">Déconnexion</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  @yield('contenu')

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
<script type="text/javascript" src="{{ secure_asset('../resources/js/jquery.stickyTableHeader.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('../resources/js/professeurtableau.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('../resources/js/eleveTLS.js') }}"></script>

</html>
