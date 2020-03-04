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
                                    <label for="select">Choix de la classe : </label>
                                    <select class="select form-control" id="classeidcs" name="classeidcs">
                                        <option value="-2" disabled>Filière</option>
                                        @foreach($classes as $classe)
                                            <option value="{{ $classe->idAnneeEtude }}">{{ $classe->libelleAnneeEtude }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="select">Choix de l'année : </label>
                                    <select class="select form-control" id="anneeidcs" name="anneeidcs">
                                        <option value="-2" disabled>Année</option>
                                        @foreach($annees as $annee)
                                            <option>{{ $annee->annee }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="select">Choix du devoir : </label>
                                    <select class="select form-control" id="notationidcs" name="notationidcs">
                                        <option value="-1">Nouvelle fiche de notation</option>
                                        @foreach($fiches as $fiche)
                                            <option value="{{ $fiche->idNotation }}">{{ $fiche->libelleNotation }}</option>
                                        @endforeach
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
                                    <label for="select">Choix du module :</label>
                                    <select class="select form-control" id="moduleidcs" name="moduleidcs">
                                        <option value="-2" disabled>Choix du module</option>
                                        @foreach($modules as $module)
                                            <option value="{{ $module->idModule }}">{{ $module->codeModule }} - {{ $module->libelleModule }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center lechoix">
                                <br>
                            </div>

                            <div class="col-lg-12">
                                @php ($x=1)
                                @foreach($lesDonneesFilieres as $lesDonneesUneFiliere)
                                    @if( $lesDonneesUneFiliere->isEmpty() )

                                        <div class="card bg-info text-white text-center">
                                            <div class="card-header">
                                                Information - Un problème est survenu
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">Veuillez vérifier que pour cette filière vous avez ajouté : <i>une/des compétence(s) </i>, <i>une/des compétence(s) détaillé(s)</i>, <i>un/des indicateur(s) de performance(s)</i> et <i>une donnée</i> </p>
                                            </div>

                                        </div>

                                    @else
                                        <div class="sticky-table table-filiere" id="{{ $lesDonneesUneFiliere[0]->idFiliere }}">
                                            <table cellspacing="0" class="table" id="table-{{ $lesDonneesUneFiliere[0]->idFiliere }}" border="0">
                                                <thead>
                                                <tr>
                                                    <td style="border: 2px solid #000000;" colspan=63 height="33" align="center" valign=middle bgcolor="#8EB4E3"><b>{{ $lesDonneesUneFiliere[0]->libelleFiliere }}</b></td>
                                                    <td style="border: 2px solid #000000;" rowspan="2" bgcolor="#93CDDD" >Indicateur de Performance</td>
                                                    <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD">Choisis</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php ($i=1)
                                                @foreach($lesDonneesUneFiliere as $uneCCPRP)
                                                    <tr id="ligne{{$x}}-{{ $uneCCPRP->idIndicateurPerformance }}-{{ $uneCCPRP->idLangue }}">
                                                        <td class="competence" style="border: 3px solid #000000;" height="106" align="center" valign=middle bgcolor="#DBEEF4">C{{$uneCCPRP->idCompetence}} - {{$uneCCPRP->libelleCompetence}}</td>
                                                        <td class="donnee" style="border: 3px solid #000000;" colspan=17 align="left" valign=middle>{{$uneCCPRP->libelleDonnee}}</td>
                                                        <td class="competencedet" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=20 align="left" valign=middle>C{{$uneCCPRP->idCompetenceDetaillee}} - {{$uneCCPRP->libelleCompetenceDetaillee}}</td>
                                                        <td class="indicateur" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=26 align="left" valign=middle>{{$uneCCPRP->libelleIndicateurPerformance}}</td>
                                                        <td class="note" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" colspan=4 align="center" valign=middle id="indicateur-{{$uneCCPRP->idIndicateurPerformance}}"><br></td>
                                                    </tr>
                                                    @php ($i++)
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                    @php ($x++)
                                @endforeach
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="fixed-bottom">
                    <div class="text-center">
                        <button class="btn btn-primary btn-sx" id="csenvoyer" type="button">Enregistrer la fiche</button>
                        <button class="btn btn-danger btn-sx" id="cssupprimer" type="button">Supprimer la fiche</button>
                    </div>
                    <br>
                </div>
            </div>
        </div>
   </div>
</div>
@endsection
