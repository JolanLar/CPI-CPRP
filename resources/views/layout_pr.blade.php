<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Partie Professeur</title>
      <!-- Fonts -->
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
      <!-- Styles -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
      <link href="{{ asset('../resources/css/accueil.css') }}" rel="stylesheet">
      <link href="{{ asset('../resources/css/theme.css') }}" rel="stylesheet">
   </head>
   <body>
       <!-- Return to Top -->
        <a href="javascript:" id="return-to-top"><i class="fas fa-chevron-up"></i></a>

      <div class="container">
         <div class="row fond_bienvenue w">
            <div class="col-lg-4 l">
               Bienvenue {{ $prenom }} {{ $nom }}
            </div>
            <div class="col-lg-4 m">
               <b>Gestion de la progression d'un étudiant</b>
            </div>
            <div class="col-lg-4 r">
               <a href="#">Imprimer</a>
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
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Gestion progression étudiant
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/professeur/cs')}}">Compétences sélectionnées</a>
                        <a class="dropdown-item" href="{{url('/professeur/tls')}}">Toutes les compétences</a>
                     </div>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Visualiser le réferentiel
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/professeur/rtc')}}">Relations tâches/compétences</a>
                        <a class="dropdown-item" href="{{url('/professeur/rcs')}}">Relations compétences/savoirs</a>
                     </div>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{url('/professeur/vr')}}">Visualiser une progression</a>
                  </li>
               </ul>
               <ul class="navbar-nav my-2 my-lg-0">
                  <li class="nav-item">
                     <a class="nav-link" href="{{url('/')}}" style="color: #d13434">Déconnexion</a>
                  </li>
               </ul>
            </div>
         </nav>
      </div>
      @yield('contenu')
@php( $url = $_SERVER['REQUEST_URI'])

       @if(strstr($url, 'livret') || strstr($url, 'histo') || strstr($url, 'radar'))
           <script src="../../../../resources/js/jquery-3.2.1.min.js"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
           <script type="text/javascript" src="../../../../resources/js/professeur.js"></script>
           <script type="text/javascript" src="../../../../../resources/js/professeurRelationT-C.js"></script>
           <script type="text/javascript" src="../../../../resources/js/jquery.stickyTableHeader.js"></script>
           <script type="text/javascript" src="../../../../resources/js/professeurtableau.js"></script>
           @else
           <script src="../../resources/js/jquery-3.2.1.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
          <script type="text/javascript" src="../../resources/js/professeur.js"></script>
          <script type="text/javascript" src="../../resources/js/professeurRelationT-C.js"></script>
          <script type="text/javascript" src="../../resources/js/professeurTLS.js"></script>
          <script type="text/javascript" src="../../resources/js/professeurtlsnote.js"></script>
          <script type="text/javascript" src="../../resources/js/jquery.stickyTableHeader.js"></script>
          <script type="text/javascript" src="../../resources/js/professeurtableau.js"></script>
        @endif

       <script>

           $(window).scroll(function()
           {
               if ($(this).scrollTop() >= 50)
               {        // If page is scrolled more than 50px
                   $('#return-to-top').fadeIn(200);    // Fade in the arrow
               }
               else
               {
                   $('#return-to-top').fadeOut(200);   // Else fade out the arrow
               }
           });
           $('#return-to-top').click(function() {      // When arrow is clicked
               $('body,html').animate({
                   scrollTop : 0                       // Scroll to top of body
               }, 500)});
       </script>

   </body>
</html>
