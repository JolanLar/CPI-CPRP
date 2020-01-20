@extends('layout_pr')
@section('contenu')
<div class="container">
   <div class="row principal">
      <div class="col-lg-12 liv">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 offset-lg-2">
                  {{ Form::open(array('url' => 'professeur/tls')) }}
                  <br>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="select">Choix de la Classe : </label>
                        <select class="select form-control" id="lyceeclasse" name="lyceeclasse">
                           @foreach($lesClasses as $uneClasse)
                           <option>
                              {{ $uneClasse->libelleAnneeEtude }}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="select">Choix de l'année : </label>
                        <select class="select form-control" id="anneidtls" name="anneidtls">
                           @foreach($lesAnneesScolaires as $uneAnnee)
                           <option>
                              {{ $uneAnnee->annee }} 
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="select">Choix de l'étudiant : </label>
                        <select class="select form-control" id="etudiantidtls" name="etudiantidtls">
                           @foreach($lesEtudiants as $unEtudiant)
                           <option>
                              {{ $unEtudiant->idUtilisateur }} : {{ $unEtudiant->Nom }} - {{ $unEtudiant->Prenom }}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  {{ Form::close() }}
               </div>
               <div class="col-lg-12">
                   <div class="sticky-table">
                     <table cellspacing="0" id="cprp" class=" table " border="0">
                        <thead>
                           <tr>
                              <td style="border: 2px solid #000000;" colspan=63 height="33" align="center" valign=middle bgcolor="#8EB4E3"><b>CPRP</b></td>
                              <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD" >Expert</td>
                              <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD" >
                                 <a class="comment-indicator"></a>
                                 <comment>Les apprentissages ne sont pas engagés ce qui justifie une aide spécifique de l'enseignant(e). L'élève n'est pas encore capable de ...</comment>
                                 A acquérir
                              </td>
                              <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD" >
                                 <a class="comment-indicator"></a>
                                 <comment>Les apprentissages sont engagés mais restent partiels, fragiles et encore très dépendants de l'aide de l'enseignant, L'élève est parfois capable, ou avec de l'aide, de ...</comment>
                                 En cours d'acquisition
                              </td>
                              <td style="border: 2px solid #000000;" colspan=3 rowspan=2 align="center" valign=middle bgcolor="#93CDDD" >
                                 <a class="comment-indicator"></a>
                                 <comment>Les apprentissages témoignent d'une réelle aisance dans des situations comprises et maîtrisées, pour autant encore très liées au contexte d'apprentissage retenu. L'élève est souvent capable de ...</comment>
                                 A renforcer
                              </td>
                              <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD" >
                                 <a class="comment-indicator"></a>
                                 <comment>Les apprentissages sont maîtrisés et utilisables dans des situations nouvelles. L'élève est capable de ...</comment>
                                 Confirmée
                              </td>
                           </tr>
                           <tr>
                              <td style="border: 2px solid #000000;" height="40" align="center" valign=middle bgcolor="#C6D9F1"><b>Compétences</b></td>
                              <td style="border: 2px solid #000000;" colspan=17 align="center" valign=middle bgcolor="#C6D9F1" ><b>Données</b></td>
                              <td style="border: 2px solid #000000; " colspan=20 align="center" valign=middle bgcolor="#C6D9F1"><b>Compétences détaillées</b></td>
                              <td style="border: 2px solid #000000; " colspan=25 align="center" valign=middle bgcolor="#C6D9F1"><b>Indicateur de performances</b></td>
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
                  <br><br>
                  <div class="sticky-table">
                     <table cellspacing="0" id="cpi" class="table " border="0">
                        <thead>
                           <tr>
                              <td style="border: 2px solid #000000;" colspan=63 height="33" align="center" valign=middle bgcolor="#da9694"><b>CPI</b></td>
                              <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#fabf8f" >Expert</td>
                              <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#fabf8f" >
                                 <a class="comment-indicator"></a>
                                 <comment>Les apprentissages ne sont pas engagés ce qui justifie une aide spécifique de l'enseignant(e). L'élève n'est pas encore capable de ...</comment>
                                 A acquérir
                              </td>
                              <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#fabf8f" >
                                 <a class="comment-indicator"></a>
                                 <comment>Les apprentissages sont engagés mais restent partiels, fragiles et encore très dépendants de l'aide de l'enseignant, L'élève est parfois capable, ou avec de l'aide, de ...</comment>
                                 En cours d'acquisition
                              </td>
                              <td style="border: 2px solid #000000;" colspan=3 rowspan=2 align="center" valign=middle bgcolor="#fabf8f" >
                                 <a class="comment-indicator"></a>
                                 <comment>Les apprentissages témoignent d'une réelle aisance dans des situations comprises et maîtrisées, pour autant encore très liées au contexte d'apprentissage retenu. L'élève est souvent capable de ...</comment>
                                 A renforcer
                              </td>
                              <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#fabf8f" >
                                 <a class="comment-indicator"></a>
                                 <comment>Les apprentissages sont maîtrisés et utilisables dans des situations nouvelles. L'élève est capable de ...</comment>
                                 Confirmée
                              </td>
                           </tr>
                           <tr>
                              <td style="border: 2px solid #000000;" height="40" align="center" valign=middle bgcolor="#e6b8b7"><b>Compétences</b></td>
                              <td style="border: 2px solid #000000;" colspan=17 align="center" valign=middle bgcolor="#e6b8b7" ><b>Données</b></td>
                              <td style="border: 2px solid #000000; " colspan=20 align="center" valign=middle bgcolor="#e6b8b7"><b>Compétences détaillées</b></td>
                              <td style="border: 2px solid #000000; " colspan=25 align="center" valign=middle bgcolor="#e6b8b7"><b>Indicateur de performances</b></td>
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
               </div>
            </div>
         </div>
         <br>
         <br>
         <br>
         <div class="row">
            <div class="col-lg-6 offset-lg-3">
               <div class="fixed-bottom">
                  <div class="text-center"><button class="btn btn-primary btn-sx" id="tlsenvoyer" type="button">Enregistrer les notes</button></div>
                  <br>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection