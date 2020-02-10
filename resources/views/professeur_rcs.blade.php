@extends('layout_pr')
@section('contenu')
<div class="container">
   <div class="row principal">
      <div class="col-lg-12 liv">
         <div class="col-lg-12" style="text-align: center;">
         <h1> Relations compétences/savoirs</h1>
      </div>
      <form class="col-lg-12 text-center">
         <div class="col-lg-12 text-center">
             @foreach($filieres as $i => $uneFiliere)
                 @if($i==0)
                     <input type="radio" class="choixref" name="choixref" value="{{$uneFiliere->libelleFiliere}}" checked>
                 @else
                     <input type="radio" class="choixref" name="choixref" value="{{$uneFiliere->libelleFiliere}}">
                 @endif
                 <label for="{{$uneFiliere->libelleFiliere}}">{{$uneFiliere->libelleFiliere}}</label>
             @endforeach
         </div>
      </form>
       @foreach($filieres as $uneFiliere)
            <table border="1" cellpadding="1"cellspacing="0" class="table table-responsive " id="tab{{ strtolower($uneFiliere->libelleFiliere) }}"  >
            <colgroup width="85"></colgroup>
            <colgroup width="313"></colgroup>
            <colgroup span="14" width="85"></colgroup>
            <tr>
                <td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan={{ $nbCompetences[$uneFiliere->idFiliere -1]  + 2}} height="29"><b><font face="Calibri" size=5 >BTS {{ strtoupper($uneFiliere->libelleFiliere) }} : Relations principales entre les comp&eacute;tences et les savoirs</font></b></td>
            </tr>
            <tr>
                <td style="border-left: 2px solid ; border-right: 1px solid " colspan=2 height="18" >COMPETENCES BTS {{$uneFiliere->libelleFiliere}}</td>
                    @foreach($competences as $key => $uneCompetence)
                        @if($uneCompetence->idFiliere == $uneFiliere->idFiliere)
                            @if ($key > 9)
                                <td id="comp{{$key}}" bgcolor="#EBF1DE"><b>{{ $uneCompetence->codeCompetence }}</b></td>
                            @else
                                <td id="comp{{$key}}" bgcolor="#F2DCDB"><b>{{ $uneCompetence->codeCompetence }}</b></td>
                            @endif
                        @endif
                    @endforeach
            </tr>
                     @foreach($lesSavoirs as $unSavoir)
                         @if($unSavoir->idFiliere == $uneFiliere->idFiliere)
                             <tr>
                                 <td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan={{ $nbCompetences[$uneFiliere->idFiliere - 1] + 2}} height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">
                                         S{{ $unSavoir->idSavoir }} - {{ $unSavoir->libelleSavoir }}
                                     </font></td>
                             </tr>
                             @foreach ($lesSavoirsDetaille as $unSavoirDetaille)
                                 {{-- si les idSavoir correspondent ajoute les sous savoir --}}
                                 @if ($unSavoirDetaille->idSavoir == $unSavoir->idSavoir && $unSavoirDetaille->idFiliere == $uneFiliere->idFiliere && $unSavoir->idFiliere == $uneFiliere->idFiliere)
                                     <tr>
                                         <td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" >
                                             <font face="Calibri">S{{$unSavoirDetaille->idSavoirDetaille}}</font></td>
                                         <td align="left" ><font face="Calibri">{{$unSavoirDetaille->titreSavoirDetaille}}</font></td>

                                         {{-- ajoute les colonnes pour les compétences --}}

                                         @for ($i = 0; $i < $nbCompetences[$uneFiliere->idFiliere - 1]; $i++)
                                             @php ($test = false)
                                             {{-- pour chaque savoirdetaille --}}
                                             @foreach ($lesCompSavoirsDetaille as $cpSS)
                                                 @if ($cpSS->idSavoirDetaille == $unSavoirDetaille->idSavoirDetaille && $cpSS->idCompetence == $i + 1 && $cpSS->idFiliere == $uneFiliere->idFiliere)
                                                     <td align="center"><b>x</b></td>
                                                     @php ($test = true)
                                                 @endif
                                             @endforeach
                                             @if ($test == false)
                                                 <td><br></td>
                                             @endif
                                         @endfor
                                     </tr>

                                     {{-- les sous-savoirsDetaille --}}
                                     @foreach($lesSousSavoirsDetaille as $unSousSavoirDetaille)
                                         @if($unSousSavoirDetaille->idSavoir == $unSavoir->idSavoir && $unSousSavoirDetaille->idSavoirDetaille == $unSavoirDetaille->idSavoirDetaille)
                                             <tr>
                                                 <td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18"
                                                     align="center" ><font face="Calibri">S{{$unSousSavoirDetaille->idSousSavoirDetaille}}</font></td>
                                                 <td align="left" ><font face="Calibri">{{$unSousSavoirDetaille->titreSousSavoirDetaille}}</font></td>

                                                 @for ($i = 0; $i < $nbCompetences[$uneFiliere->idFiliere-1]; $i++)
                                                     @php ($test = false)

                                                     @foreach ($lesCompSousSavoirsDetaille as $cpSSD)
                                                         @if ($cpSSD->idSousSavoirDetaille == $unSousSavoirDetaille->idSousSavoirDetaille && $cpSSD->idCompetence == $i + 1)
                                                             <td align="center"><b>x</b></td>
                                                             @php ($test = true)
                                                         @endif
                                                     @endforeach
                                                     @if ($test == false)
                                                         <td><br></td>
                                                     @endif
                                                 @endfor
                                             </tr>
                                         @endif
                                     @endforeach
                                 @endif
                             @endforeach
                         @endif
                     @endforeach
        @endforeach
        </table>

      </div>
   </div>
</div>
@endsection
