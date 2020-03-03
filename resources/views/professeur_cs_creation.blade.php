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
                                    <select class="select form-control" id="notationidcs" name="notationidcs">
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
                                                    <td style="border: 2px solid #000000;" rowspan="2" bgcolor="#93CDDD" >Langue *Optionnel</td>
                                                    <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD">Expert</td>
                                                    <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD">
                                                        <a class="comment-indicator"></a>
                                                        <comment>Les apprentissages ne sont pas engagés ce qui justifie une aide spécifique de l'enseignant(e). L'élève n'est pas encore capable de ...</comment>
                                                        A acquérir
                                                    </td>
                                                    <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD">
                                                        <a class="comment-indicator"></a>
                                                        <comment>Les apprentissages sont engagés mais restent partiels, fragiles et encore très dépendants de l'aide de l'enseignant, L'élève est parfois capable, ou avec de l'aide, de ...</comment>
                                                        En cours d'acquisition
                                                    </td>
                                                    <td style="border: 2px solid #000000;" colspan=3 rowspan=2 align="center" valign=middle bgcolor="#93CDDD">
                                                        <a class="comment-indicator"></a>
                                                        <comment>Les apprentissages témoignent d'une réelle aisance dans des situations comprises et maîtrisées, pour autant encore très liées au contexte d'apprentissage retenu. L'élève est souvent capable de ...</comment>
                                                        A renforcer
                                                    </td>
                                                    <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD">
                                                        <a class="comment-indicator"></a>
                                                        <comment>Les apprentissages sont maîtrisés et utilisables dans des situations nouvelles. L'élève est capable de ...</comment>
                                                        Confirmée
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 2px solid #000000;" height="40" align="center" valign=middle bgcolor="#C6D9F1"><b>Compétences</b></td>
                                                    <td style="border: 2px solid #000000;" colspan=17 align="center" valign=middle bgcolor="#C6D9F1"><b>Données</b></td>
                                                    <td style="border: 2px solid #000000; " colspan=20 align="center" valign=middle bgcolor="#C6D9F1"><b>Compétences détaillées</b></td>
                                                    <td style="border: 2px solid #000000; " colspan=25 align="center" valign=middle bgcolor="#C6D9F1"><b>Indicateur de performances</b></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php ($i=1)
                                                @foreach($lesDonneesUneFiliere as $uneCCPRP)
                                                    <tr id="ligne{{$x}}-{{ $uneCCPRP->idIndicateurPerformance }}-{{ $uneCCPRP->idLangue }}">
                                                        <td class="competence" style="border: 3px solid #000000;" height="106" align="center" valign=middle bgcolor="#DBEEF4">C{{$uneCCPRP->idCompetence}} - {{$uneCCPRP->libelleCompetence}}</td>
                                                        <td class="donnee" style="border: 3px solid #000000;" colspan=17 align="left" valign=middle>{{$uneCCPRP->libelleDonnee}}</td>
                                                        <td class="competencedet" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=20 align="left" valign=middle>C{{$uneCCPRP->idCompetenceDetaillee}} - {{$uneCCPRP->libelleCompetenceDetaillee}}</td>
                                                        @if(!isset($uneCCPRP->idLangue))
                                                            <td class="indicateur" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=26 align="left" valign=middle>{{$uneCCPRP->libelleIndicateurPerformance}}</td>
                                                        @else
                                                            <td class="indicateur" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=25 align="left" valign=middle>{{$uneCCPRP->libelleIndicateurPerformance}}</td>
                                                            <td style="border: 1px solid #000000; border-top: 3px solid #000000;" >{{$uneCCPRP->libelleLangue}}</td>
                                                        @endif
                                                        <td class="note" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" colspan=4 align="center" valign=middle><br></td>
                                                        <td class="note aa" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" colspan=4 align="center" valign=middle><br></td>
                                                        <td class="note ca1" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=2 align="center" valign=middle><br></td>
                                                        <td class="note ca2" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=2 align="center" valign=middle><br></td>
                                                        <td class="note ar1" style="border-top: 3px solid #000000; border-bottom: 1px solid #000000; border-left: 3px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><br></td>
                                                        <td class="note ar2" style="border: 1px solid #000000; border-top: 3px solid #000000;" align="center" valign=middle><br></td>
                                                        <td class="note ar3" style="border: 1px solid #000000; border-top: 3px solid #000000; border-right: 3px solid #000000" align="center" valign=middle><br></td>
                                                        <td class="note c1" style="border: 1px solid #000000; border-top: 3px solid #000000;" align="center" valign=middle><br></td>
                                                        <td class="note c2" style="border: 1px solid #000000; border-top: 3px solid #000000;" align="center" valign=middle><br></td>
                                                        <td class="note c3" style="border: 1px solid #000000; border-top: 3px solid #000000;" align="center" valign=middle><br></td>
                                                        <td class="note c4" style="border: 1px solid #000000; border-top: 3px solid #000000; border-right: 3px solid #000000" align="center" valign=middle><br></td>
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

   </div>
</div>
@endsection
