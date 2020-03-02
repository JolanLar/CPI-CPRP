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

        <div class="col-lg-12 liv">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        {{ Form::open(array('url' => 'professeur/cs/creation')) }}
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="select">Choix du devoir : </label>
                                    <select class="select form-control" id="notationidcs" name="notationidcs">
                                        <option value="-1">Nouvelle fiche de notation</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row col-lg-12">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <select class="form-control" name="notationtypeid" id="notationtypeid">
                                            <option value="-2" disabled>Type</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->idTypeNotation }}">{{ $type->libelleTypeNotation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="notationnamecs" id="notationnamecs" placeholder="Nom du devoir">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="select">Choix de l'année : </label>
                                    <select class="select form-control" id="anneeidcs" name="anneeidcs">
                                        <option value="-2" disabled>Année</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="select">Choix de la filière : </label>
                                    <select class="select form-control" id="filiereidcs" name="filiereidcs">
                                        <option value="-2" disabled>Filière</option>
                                    </select>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

   </div>
</div>
@endsection
