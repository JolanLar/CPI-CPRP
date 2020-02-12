<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>Gestion de la base</title>

   <!-- Fonts -->
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
   <!-- Styles -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">

   <link href="../resources/css/back-css/hamburgers.css" rel="stylesheet" media="all">
   <link href="../resources/css/theme.css" rel="stylesheet" media="all">
   <link href="../resources/css/back-css/themify-icons.css" rel="stylesheet">
   <link href="../resources/css/base.css" rel="stylesheet">

</head>

<body>
   <div class="page-wrapper">
      <header class="header-desktop3 d-none d-lg-block">
         <div class="section__content section__content--p35">
            <div class="header3-wrap">
               <div class="header__logo">
                  <a class="textet">
                     Gestion de la BDD
                  </a>
               </div>
               <div class="header__navbar">
                  <ul class="list-unstyled">
                     <li>
                        <a href={{url('/gestionutilisateur')}}><i class="fas fa-user"></i><span class="bot-line"></span>Gestion des utilisateurs</a>
                     </li>
                     <li class="has-sub">
                        <a href="#">
                           <i class="fas fa-users "></i>Gestion des classes
                           <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                           <li>
                              <a href={{url('/gestioncreationclasse')}}>Création des classes</a>
                           </li>
                           <li>
                              <a href={{url('/gestionclasse')}}>Gestion des classes</a>
                           </li>
                           <li>
                              <a href={{url('/gestionfiliere')}}>Gestion des filières</a>
                           </li>
                        </ul>
                     </li>
                     <li class="has-sub">
                        <a href="#">
                           <i class="fas fa-database "></i>Gestion du référentiel
                           <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                           <li>
                              <a href={{url('/gestioncompetence')}}>Gestion des compétences</a>
                           </li>
                           <li>
                              <a href={{url('/gestioncompetencedetaillee')}}>Gestion des compétences détaillées</a>
                           </li>
                           <li>
                              <a href={{url('/gestionindicateurperformance')}}>Gestion des indicateurs de performance </a>
                           </li>
                           <li>
                              <a href={{url('/gestiondonnee')}}>Gestion des données</a>
                           </li>
                           <li>
                              <a href={{url('/gestionsavoir')}}>Gestion des savoirs</a>
                           </li>
                           <li>
                              <a href={{url('/gestionsavoirdetaille')}}>Gestion des savoirs détaillés</a>
                           </li>
                           <li>
                              <a href={{url('/gestionsoussavoirdetaille')}}>Gestion des sous savoirs détaillés</a>
                           </li>
                           <li>
                              <a href={{url('/gestionactivite')}}>Gestion des activités</a>
                           </li>
                           <li>
                              <a href={{url('/gestiontache')}}>Gestion des tâches</a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}" style="color: #d13434">Déconnexion</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </header>
      <!-- END HEADER DESKTOP-->
      <!-- HEADER MOBILE-->
      <header class="header-mobile header-mobile-2 d-block d-lg-none">
         <div class="header-mobile__bar">
            <div class="container-fluid">
               <div class="header-mobile-inner">
                  <a class="textet">
                     Gestion de la BDD
                  </a>
                  <button class="hamburger hamburger--slider" type="button">
                     <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                     </span>
                  </button>
               </div>
            </div>
         </div>
         <nav class="navbar-mobile">
            <div class="container-fluid">
               <ul class="navbar-mobile__list list-unstyled">
                  <li>
                     <a href={{url('/gestionutilisateur')}}>
                        <i class="fas fa-user"></i>Gestion des utilisateurs</a>
                  </li>
                  <li class="has-sub">
                     <a class="js-arrow" href="#">
                        <i class="fas fa-users "></i>Gestion des classes</a>
                     <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                           <a href={{url('/gestioncreationclasse')}}>Création des classes</a>
                        </li>
                        <li>
                           <a href={{url('/gestionclasse')}}>Gestion des classes</a>
                        </li>
                        <li>
                           <a href={{url('/gestionfiliere')}}>Gestion des filières</a>
                        </li>
                     </ul>
                  </li>
                  <li class="has-sub">
                     <a class="js-arrow" href="#">
                        <i class="fas fa-database "></i>Gestion du référentiel</a>
                     <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                           <a href={{url('/gestioncompetence')}}>Gestion des compétences</a>
                        </li>
                        <li>
                           <a href={{url('/gestioncompetencedetaillee')}}>Gestion des compétences détaillées</a>
                        </li>
                        <li>
                           <a href={{url('/gestionindicateurperformance')}}>Gestion des indicateurs de performance </a>
                        </li>
                        <li>
                           <a href={{url('/gestiondonnee')}}>Gestion des données</a>
                        </li>
                        <li>
                           <a href={{url('/gestionsavoir')}}>Gestion des savoirs</a>
                        </li>
                        <li>
                           <a href={{url('/gestionsavoirdetaille')}}>Gestion des savoirs détaillés</a>
                        </li>
                        <li>
                           <a href={{url('/gestionsoussavoirdetaille')}}>Gestion des sous savoirs détaillés</a>
                        </li>
                        <li>
                           <a href={{url('/gestionactivite')}}>Gestion des activités</a>
                        </li>
                        <li>
                           <a href={{url('/gestiontache')}}>Gestion des tâches</a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{url('/')}}" style="color: #d13434">Déconnexion</a>
                  </li>
               </ul>
            </div>
         </nav>
      </header>
      <div class="page-content--bgf7">
         <br>
         @yield('contenu')
         <br>
      </div>
   </div>
   <script src="../resources/js/jquery-3.2.1.min.js"></script>
   <!-- bootstrap 4 js -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <!-- others plugins -->
   <script src="../resources/js/backjs/creationutilisateur.js"></script>
   <script src="../resources/js/backjs/backListeFiliere.js"></script>
   <script src="../resources/js/backjs/backListeTache.js"></script>
   <script src="../resources/js/backjs/backListeCompetence.js"></script>
   <script src="../resources/js/backjs/backListeCompetenceDetaillee.js"></script>
   <script src="../resources/js/backjs/backListeIndicateurPerformance.js"></script>
   <script src="../resources/js/backjs/backListeUtilisateur.js"></script>
   <script src="../resources/js/backjs/backListeDonnee.js"></script>
   <script src="../resources/js/backjs/backListeUtilisateurClasse.js"></script>
   <script src="../resources/js/backjs/animsition.min.js"></script>
   <script src="../resources/js/backjs/backListeClasse.js"></script>
   <script src="../resources/js/backjs/backListeSavoir.js"></script>
   <script src="../resources/js/backjs/backListeSavoirDetaille.js"></script>
   <script src="../resources/js/backjs/backListeSousSavoirDetaille.js"></script>
   <script src="../resources/js/backjs/main.js"></script>
</body>

</html>