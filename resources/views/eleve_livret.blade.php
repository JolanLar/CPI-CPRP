@extends('layout_el')

@section('contenu')
<div class="container">
<p id="idUtilisateur" style="display:none">{{ $idUtilisateur }}</p>
    <div class="row principal">
        <div class="col-lg-12 text-center lechoix">
            @foreach($lesFilieres as $i => $uneFiliere)
                <input type="radio" class="choixref" name="choixref" value="{{$uneFiliere->idFiliere}}">
                <label for="{{$uneFiliere->libelleFiliere}}">{{$uneFiliere->libelleFiliere}}</label>
            @endforeach
        </div>
        <div class="col-lg-12 liv">
            <br>
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
                        <tr id="ligne1-{{ $uneCCPRP->idIndicateurPerformance }}">
                            <td class="competence" style="border: 3px solid #000000;" height="106" align="center" valign=middle bgcolor="#DBEEF4">C{{$uneCCPRP->idCompetence}} - {{$uneCCPRP->libelleCompetence}}</td>
                            <td class="donnee" style="border: 3px solid #000000;" colspan=17 align="left" valign=middle>{{$uneCCPRP->libelleDonnee}}</td>
                            <td class="competencedet" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=20 align="left" valign=middle>C{{$uneCCPRP->idCompetenceDetaillee}} - {{$uneCCPRP->libelleCompetenceDetaillee}}</td>
                            <td class="indicateur" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=25 align="left" valign=middle>{{$uneCCPRP->libelleIndicateurPerformance}}</td>
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
    </div>
</div>

@endsection
