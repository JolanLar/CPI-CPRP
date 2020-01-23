@extends('layout_el')

@section('contenu')

    <div class="container">
        <div class="row principal">
            <div class="col-lg-12 liv">
                @if ($fil == 2)
                    <div class="sticky-table" id="livret">
                        <table cellspacing="0" id="cprp" class="table table-responsive-stack" border="0">
                            <thead>
                            <tr>
                                <td style="border: 2px solid #000000;" colspan=63 height="33" align="center" valign=middle bgcolor="#8EB4E3"><b>CPRP</b></td>
                                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD" >Expert</td>
                                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD" >
                                    <a class="comment-indicator"></a>
                                    <comment>Les apprentissages ne sont pas engagés ce qui justifie une aide spécifique de l'enseignant(e). L'élève n'est pas encore capable de ...</comment>
                                    <font face="Calibri" size=3 color="#000000">A acquérir</font>
                                </td>
                                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD" >
                                    <a class="comment-indicator"></a>
                                    <comment>Les apprentissages sont engagés mais restent partiels, fragiles et encore très dépendants de l'aide de l'enseignant, L'élève est parfois capable, ou avec de l'aide, de ...</comment>
                                    <font face="Calibri" size=3 color="#000000">En cours d'acquisition</font>
                                </td>
                                <td style="border: 2px solid #000000;" colspan=3 rowspan=2 align="center" valign=middle bgcolor="#93CDDD" >
                                    <a class="comment-indicator"></a>
                                    <comment>Les apprentissages témoignent d'une réelle aisance dans des situations comprises et maîtrisées, pour autant encore très liées au contexte d'apprentissage retenu. L'élève est souvent capable de ...</comment>
                                    <font face="Calibri" size=4 color="#000000">A renforcer</font>
                                </td>
                                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD" >
                                    <a class="comment-indicator"></a>
                                    <comment>Les apprentissages sont maîtrisés et utilisables dans des situations nouvelles. L'élève est capable de ...</comment>
                                    <font face="Calibri" size=4 color="#000000">Confirmée</font>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid #000000;" height="40" align="center" valign=middle bgcolor="#C6D9F1"><b><font face="Calibri" size=4 color="#000000">Compétences</font></b></td>
                                <td style="border: 2px solid #000000;" colspan=17 align="center" valign=middle bgcolor="#C6D9F1" ><b><font face="Calibri" size=4 color="#000000">Données</font></b></td>
                                <td style="border: 2px solid #000000; " colspan=20 align="center" valign=middle bgcolor="#C6D9F1"><b><font face="Calibri" size=4 color="#000000">Compétences détaillées</font></b></td>
                                <td style="border: 2px solid #000000; " colspan=25 align="center" valign=middle bgcolor="#C6D9F1"><b><font face="Calibri" size=4 color="#000000">Indicateur de performances</font></b></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lesCCPRP as $uneCCPRP)
                                <tr id="ligne1-{{ $uneCCPRP->idIndicateurPerformance }}">
                                    <td class="competence" style="border: 3px solid #000000;" height="106" align="center" valign=middle bgcolor="#DBEEF4">{{$uneCCPRP->idCompetence}} - {{$uneCCPRP->libelleCompetence}}</td>
                                    <td class="donnee" style="border: 3px solid #000000;" colspan=17   align="left"  valign=middle>{{$uneCCPRP->libelleDonnee}}</td>
                                    <td class="competencedet" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=20 align="left" valign=middle>{{$uneCCPRP->idCompetenceDetaillee}} - {{$uneCCPRP->libelleCompetenceDetaillee}}</td>
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
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else

                    <div class="sticky-table">
                        <table cellspacing="0" id="cpi" class="table " border="0">
                            <thead>
                            <tr>
                                <td style="border: 2px solid #000000;" colspan=63 height="33" align="center" valign=middle bgcolor="#da9694"><b>CPI</b></td>
                                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#fabf8f" >Expert</td>
                                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#fabf8f" >
                                    <a class="comment-indicator"></a>
                                    <comment>Les apprentissages ne sont pas engagés ce qui justifie une aide spécifique de l'enseignant(e). L'élève n'est pas encore capable de ...</comment>
                                    <font face="Calibri" size=3 color="#000000">A acquérir</font>
                                </td>
                                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#fabf8f" >
                                    <a class="comment-indicator"></a>
                                    <comment>Les apprentissages sont engagés mais restent partiels, fragiles et encore très dépendants de l'aide de l'enseignant, L'élève est parfois capable, ou avec de l'aide, de ...</comment>
                                    <font face="Calibri" size=3 color="#000000">En cours d'acquisition</font>
                                </td>
                                <td style="border: 2px solid #000000;" colspan=3 rowspan=2 align="center" valign=middle bgcolor="#fabf8f" >
                                    <a class="comment-indicator"></a>
                                    <comment>Les apprentissages témoignent d'une réelle aisance dans des situations comprises et maîtrisées, pour autant encore très liées au contexte d'apprentissage retenu. L'élève est souvent capable de ...</comment>
                                    <font face="Calibri" size=4 color="#000000">A renforcer</font>
                                </td>
                                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#fabf8f" >
                                    <a class="comment-indicator"></a>
                                    <comment>Les apprentissages sont maîtrisés et utilisables dans des situations nouvelles. L'élève est capable de ...</comment>
                                    <font face="Calibri" size=4 color="#000000">Confirmée</font>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid #000000;" height="40" align="center" valign=middle bgcolor="#e6b8b7"><b><font face="Calibri" size=4 color="#000000">Compétences</font></b></td>
                                <td style="border: 2px solid #000000;" colspan=17 align="center" valign=middle bgcolor="#e6b8b7" ><b><font face="Calibri" size=4 color="#000000">Données</font></b></td>
                                <td style="border: 2px solid #000000; " colspan=20 align="center" valign=middle bgcolor="#e6b8b7"><b><font face="Calibri" size=4 color="#000000">Compétences détaillées</font></b></td>
                                <td style="border: 2px solid #000000; " colspan=25 align="center" valign=middle bgcolor="#e6b8b7"><b><font face="Calibri" size=4 color="#000000">Indicateur de performances</font></b></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lesCCPI as $uneCCPI)
                                <tr id="ligne2-{{ $uneCCPI->idIndicateurPerformance }}">
                                    <td class="competence" style="border: 3px solid #000000;" height="106" align="center" valign=middle bgcolor="#f2dcdb">{{$uneCCPI->idCompetence}} - {{$uneCCPI->libelleCompetence}}</td>
                                    <td class="donnee" style="border: 3px solid #000000;" colspan=17   align="left"  valign=middle>{{$uneCCPI->libelleDonnee}}</td>
                                    <td class="competencedet" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=20 align="left" valign=middle>{{$uneCCPI->idCompetenceDetaillee}} - {{$uneCCPI->libelleCompetenceDetaillee}}</td>
                                    <td class="indicateur" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=25 align="left" valign=middle>{{$uneCCPI->libelleIndicateurPerformance}}</td>
                                    <td class="note" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" colspan=4 align="center" valign=middle><br></td>
                                    <td class="note aa" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" colspan=4 align="center" valign=middle><br></td>
                                    <td class="note ca1"style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=2 align="center" valign=middle><br></td>
                                    <td class="note ca2"style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=2 align="center" valign=middle><br></td>
                                    <td class="note ar1"style="border-top: 3px solid #000000; border-bottom: 1px solid #000000; border-left: 3px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><br></td>
                                    <td class="note ar2"style="border: 1px solid #000000; border-top: 3px solid #000000;" align="center" valign=middle><br></td>
                                    <td class="note ar3"style="border: 1px solid #000000; border-top: 3px solid #000000; border-right: 3px solid #000000" align="center" valign=middle><br></td>
                                    <td class="note c1" style="border: 1px solid #000000; border-top: 3px solid #000000;" align="center" valign=middle><br></td>
                                    <td class="note c2" style="border: 1px solid #000000; border-top: 3px solid #000000;" align="center" valign=middle><br></td>
                                    <td class="note c3" style="border: 1px solid #000000; border-top: 3px solid #000000;" align="center" valign=middle><br></td>
                                    <td class="note c4" style="border: 1px solid #000000; border-top: 3px solid #000000; border-right: 3px solid #000000" align="center" valign=middle><br></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
