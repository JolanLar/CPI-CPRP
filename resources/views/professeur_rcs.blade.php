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
            <input type="radio" class="choixref" name="choixref2" value="cpi" checked>
            <label for="cpi">CPI</label>
            <input type="radio" class="choixref" name="choixref2" value="cprp">
            <label for="cprp">CPRP</label>
         </div>
      </form>
         <table class="table table-responsive" id="tableaurcsCPI" cellspacing="0" border="0">
	<colgroup width="85"></colgroup>
	<colgroup width="313"></colgroup>
	<colgroup span="14" width="85"></colgroup>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan={{$countCPI + 2}} height="29"><b><font face="Calibri" size=5 >BTS CPI : Relations principales entre les comp&eacute;tences et les savoirs</font></b></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid ; border-right: 1px solid " colspan=2 height="18" >COMPETENCES BTS CPI</td>

		{{-- affiche l'ensemble des compétences pour la filière CPi --}}
        @foreach($lesCompetencesCPI as $key => $uneCompetence)

            @if ($key > 3)
                <td id="comp{{$key}}" bgcolor="#EBF1DE"><b>{{ $uneCompetence->codeCompetence }}</b></td>
            @else
                <td id="comp{{$key}}" bgcolor="#F2DCDB"><b>{{ $uneCompetence->codeCompetence }}</b></td>
            @endif


		@endforeach

    </tr>

	{{-- boucle sur le tableau lesSavoir --}}
    @foreach ($lesSavoirsCPI as $unSavoir)
    {{-- les savoirs --}}
        <tr>
            <td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">
                S{{ $unSavoir->idSavoir }} - {{ $unSavoir->libelleSavoir }}
            </font></td>
        </tr>

    {{-- les sous-savoirs pour chaque Savoir--}}
        @foreach ($lesSavoirsDetailleCPI as $unSavoirDetaille)
			{{-- si les idSavoir correspondent ajoute les sous savoir --}}
            @if ($unSavoirDetaille->idSavoir == $unSavoir->idSavoir)
                <tr>
                    <td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" >
                        <font face="Calibri">S{{$unSavoirDetaille->idSavoirDetaille}}</font></td>
                    <td align="left" ><font face="Calibri">{{$unSavoirDetaille->titreSavoirDetaille}}</font></td>

                {{-- ajoute les colonnes pour les compétences --}}

                @for ($i = 0; $i < $countCPI; $i++)
                    @php ($test = false)

                {{-- pour chaque savoirdetaille --}}
                    @foreach ($lesCompSavoirsDetailleCPI as $cpSS)

                        @if ($cpSS->idSavoirDetaille == $unSavoirDetaille->idSavoirDetaille &&$cpSS->idCompetence == $i + 1)
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
                 @foreach($lesSousSavoirsDetailleCPI as $unSousSavoirDetaille)

                     @if($unSousSavoirDetaille->idSavoir == $unSavoir->idSavoir && $unSousSavoirDetaille->idSavoirDetaille == $unSavoirDetaille->idSavoirDetaille)
                         <tr>
                             <td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18"
                                 align="center" ><font face="Calibri">S{{$unSousSavoirDetaille->idSousSavoirDetaille}}</font></td>
                             <td align="left" ><font face="Calibri">{{$unSousSavoirDetaille->titreSousSavoirDetaille}}</font></td>

                             @for ($i = 0; $i < $countCPI; $i++)
                                 @php ($test = false)

                                 @foreach ($lesCompSousSavoirsDetailleCPI as $cpSSD)
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

    @endforeach

</table>

{{-- Autre tableau --}}
          <table class="table table-responsive" id="tableaurcsCPRP" cellspacing="0" border="0">
	<colgroup width="85"></colgroup>
	<colgroup width="647"></colgroup>
	<colgroup span="18" width="85"></colgroup>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan={{$countCPRP + 2}} height="29" align="center" ><b><font face="Calibri" size=5>BTS CPRP : Relations principales entre les compétences et les savoirs</font></b></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid ; border-right: 1px solid " colspan=2 height="18" align="center" >COMPETENCES BTS CPRP</td>
        {{-- affiche l'ensemble des compétences pour la filière CPRP --}}
        @foreach($lesCompetencesCPRP as $key => $uneCompetence)

            @if ($key > 3)
                <td id="comp{{$key}}" bgcolor="#EBF1DE"><b>{{ $uneCompetence->codeCompetence }}</b></td>
            @else
                <td id="comp{{$key}}" bgcolor="#F2DCDB"><b>{{ $uneCompetence->codeCompetence }}</b></td>
            @endif


        @endforeach

    </tr>

      {{-- boucle sur le tableau lesSavoir --}}
      @foreach ($lesSavoirsCPRP as $unSavoir)
          {{-- les savoirs --}}
          <tr>
              <td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">
                      S{{ $unSavoir->idSavoir }} - {{ $unSavoir->libelleSavoir }}
                  </font></td>
          </tr>

          {{-- les sous-savoirs pour chaque Savoir--}}
          @foreach ($lesSavoirsDetailleCPRP as $unSavoirDetaille)
              {{-- si les idSavoir correspondent ajoute les sous savoir --}}
              @if ($unSavoirDetaille->idSavoir == $unSavoir->idSavoir)
                  <tr>
                      <td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" >
                          <font face="Calibri">S{{$unSavoirDetaille->idSavoirDetaille}}</font></td>
                      <td align="left" ><font face="Calibri">{{$unSavoirDetaille->titreSavoirDetaille}}</font></td>

                      {{-- ajoute les colonnes pour les compétences --}}

                      @for ($i = 0; $i < $countCPRP; $i++)
                          @php ($test = false)

                          {{-- pour chaque savoirdetaille --}}
                          @foreach ($lesCompSavoirsDetailleCPRP as $cpSS)

                              @if ($cpSS->idSavoirDetaille == $unSavoirDetaille->idSavoirDetaille &&$cpSS->idCompetence == $i + 1)
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
                  @foreach($lesSousSavoirsDetailleCPRP as $unSousSavoirDetaille)

                      @if($unSousSavoirDetaille->idSavoir == $unSavoir->idSavoir && $unSousSavoirDetaille->idSavoirDetaille == $unSavoirDetaille->idSavoirDetaille)
                          <tr>
                              <td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18"
                                  align="center" ><font face="Calibri">S{{$unSousSavoirDetaille->idSousSavoirDetaille}}</font></td>
                              <td align="left" ><font face="Calibri">{{$unSousSavoirDetaille->titreSousSavoirDetaille}}</font></td>

                              @for ($i = 0; $i < $countCPI; $i++)
                                  @php ($test = false)

                                  @foreach ($lesCompSousSavoirsDetailleCPRP as $cpSSD)
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

      @endforeach
</table>

      </div>
   </div>
</div>
@endsection
