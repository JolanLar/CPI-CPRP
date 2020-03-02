@extends('layout_pr')
@section('contenu')
<div class="container">
   <div class="row principal">
      <div class="col-lg-12" style="text-align: center;">
         <h1> Relations tâches/compétences</h1>
      </div>
      <form class="col-lg-12 text-center">
         <div class="col-lg-12 text-center lechoix">
            @foreach($filieres as $i => $uneFiliere)
            <input type="radio" class="choixref" name="choixref" value="{{$uneFiliere->libelleFiliere}}" >
            <label for="{{$uneFiliere->libelleFiliere}}">{{$uneFiliere->libelleFiliere}}</label>
            @endforeach
         </div>
      </form>
      @foreach($filieres as $uneFiliere)
      <table class="table table-responsive" id="tab{{ strtolower($uneFiliere->libelleFiliere) }}" style='border-collapse:collapse;table-layout:fixed;'>
         <tr>
            <td colspan=2 rowspan=2 class=activite>Relations entre les activités
               professionnelles et les compétences du BTS {{$uneFiliere->libelleFiliere}}
            </td>
            <td colspan=4 rowspan=2 class="titre jaunec">COMPETENCES TRANVERSALES</td>
            <td colspan={{ $nbCompetences[$uneFiliere->idFiliere-1]-4 }} rowspan=2 class="titre rouge">COMPETENCES CŒUR DE METIERS</td>
         </tr>
         <tr>
         </tr>
         <tr>
            <td class=tache>Activités</td>
            <td class=tache>Tâches</td>
            @foreach($competences as $uneCompetence)
            @if($uneCompetence->idFiliere == $uneFiliere->idFiliere)
            <td>{{ $uneCompetence->codeCompetence }}</td>
            @endif
            @endforeach
         </tr>
         @foreach($activite as $uneActivite)
         @if($uneActivite->idFiliere==$uneFiliere->idFiliere)
         <tr>
            {{-- Retire 1 pour correspondre au index du tableau --}}
            {{-- Ajouter 1 car nous passons directement à un nouveau "tr" après celui de l'activite --}}
            <td rowspan={{ $nbTaches[$uneFiliere->idFiliere-1][$uneActivite->idActivite-1]+1 }}  style='background: rgba( {{ rand(0,255) }}, {{ rand(0,255) }}, {{ rand(0,255) }}, 0.3)' class="tache">{{ $uneActivite->libelleActivite }}</td>
         </tr>
         @foreach($tache as $uneTache)
         @if($uneTache->idFiliere==$uneFiliere->idFiliere&&$uneTache->idActivite==$uneActivite->idActivite)
         <tr>
            <td class=tache>A{{ $uneActivite->idActivite }}-T{{ $uneTache->idTache }}</td>
            @for($i = 0; $i < $nbCompetences[$uneFiliere->idFiliere-1]; $i++)
            @php ($test = false)
               @foreach ($contenir as $unContenir)
                  @if($unContenir->idFiliere==$uneFiliere->idFiliere&&$unContenir->idActivite==$uneActivite->idActivite&&$unContenir->idTache==$uneTache->idTache&&$unContenir->idCompetence==$i+1)
                  <td>{{ $unContenir->niveau }}</td>
                  @php ($test = true)
                  @endif
               @endforeach
               @if ($test==false)
               <td></td>
               @endif
            @endfor
         </tr>
         @endif
         @endforeach
         @endif
         @endforeach
         @if($uneFiliere->idFiliere==1)
         <tr>
            <td colspan=2 align=left>Epreuves de certification</td>
            <td colspan=14></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve bleuc">U41-Expression du besoin et CdCf</td>
            <td></td>
            <td class=bleuc>C2</td>
            <td></td>
            <td></td>
            <td class=bleuc>C5</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve gris">U42-Conception préliminaire</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=gris>C6</td>
            <td></td>
            <td class=gris>C8</td>
            <td class=gris>C9</td>
            <td class=gris>C10</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class=" epreuve vert">U52-Soutenance du rapport de stage</td>
            <td class=vert>C1</td>
            <td></td>
            <td class=vert>C3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve jaune">U51-Conception détaillée</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune>C7</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune>C12</td>
            <td></td>
            <td class=jaune>C14</td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve jaune">U61-Projet de prototypage</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune>C13</td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve jaune">U62-Projet collaboratif d'optimisation</td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune>C4</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune>C11</td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         @endif
         @if($uneFiliere->idFiliere==2)
         <tr>
            <td colspan=2 align=left>Epreuves de certification</td>
            <td colspan=18></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve bleuc">U4 - Conception préliminaire </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=bleuc>C6</td>
            <td></td>
            <td class=bleuc>C8</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve vert">U5 - Projet industriel</td>
            <td></td>
            <td class=vert>C2</td>
            <td></td>
            <td></td>
            <td class=vert>C5</td>
            <td></td>
            <td></td>
            <td></td>
            <td class=vert>C9</td>
            <td class=vert>C10</td>
            <td class=vert>C11</td>
            <td></td>
            <td class=violet>C13</td>
            <td class=violet>C14</td>
            <td></td>
            <td></td>
            <td class=violet>Cb17</td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class=" epreuve bleuc">U61 - Projet collaboratif</td>
            <td></td>
            <td></td>
            <td></td>
            <td class=bleuc>C4</td>
            <td></td>
            <td></td>
            <td class=bleuc>C7</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve orange">U62 - Gestion et suivi de réalisation en entreprise</td>
            <td class=orange>C1</td>
            <td></td>
            <td class=orange>C3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=orange>C12</td>
            <td></td>
            <td></td>
            <td class=orange>C15</td>
            <td class=orange>C16</td>
            <td></td>
            <td class=orange>Cb18</td>
         </tr>
         @endif
      </table>
      @endforeach
   </div>
</div>
@endsection
