
<div class="col-lg-10 mt-2 ">
    Étudiant actuel : <b id="idUtilisateur">{{$idUtilisateur}}</b>
</div>
<div class="col-lg-2 text-right" >
    <a class="m-2" href="{{ url('/professeur/vr') }}">Retour vers la séléction</a>
</div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light col-lg-12">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('professeur/vr/'. $idUtilisateur .'/histo') ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('/professeur/vr/'. $idUtilisateur. '/histo' )}}">Histogramme</a>
                </li>
                <li class="nav-item {{ Request::is('professeur/vr/'. $idUtilisateur .'/radar') ? 'active' : '' }} ">
                    <a class="nav-link" href="{{url('/professeur/vr/'. $idUtilisateur .'/radar')}}">Radar</a>
                </li>
                <li class="nav-item {{ Request::is('professeur/vr/'. $idUtilisateur .'/livret') ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('/professeur/vr/'. $idUtilisateur .'/livret')}}">Livret <span class="sr-only">(current)</span></a>
                </li>
            </ul>

        </div>
    </nav>

