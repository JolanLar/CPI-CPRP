@extends('layout_pr')
@section('contenu')
<div class="container">
   <div class="row principal">

          <nav class="navbar navbar-expand-lg navbar-light bg-light col-lg-12">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>

                   <div class="collapse navbar-collapse" id="navbarSupportedContent">
                       <ul class="navbar-nav mr-auto">
                           <li class="nav-item {{ Request::is('professeur/cs') ? 'active' : '' }}" >
                               <a class="nav-link"  href="{{url('/professeur/cs')}}" >Ajouter une notation</a>
                           </li>
                           <li class="nav-item {{ Request::is('professeur/cs/gestion') ? 'active' : '' }} ">
                               <a class="nav-link" href="{{url('/professeur/cs/gestion')}}" >Gestion des notation</a>
                           </li>
                       </ul>
                   </div>
          </nav>

          CC
   </div>
</div>
@endsection
