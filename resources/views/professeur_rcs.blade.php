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
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=16 height="29"><b><font face="Calibri" size=5 >BTS CPI : Relations principales entre les comp&eacute;tences et les savoirs</font></b></td>
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
                {{ $unSavoir->idSavoir }} - {{ $unSavoir->libelleSavoir }}
            </font></td>
        </tr>
    {{-- les sous-savoirs --}}
        @foreach ($lesSousSavoirsCPI as $unSousSavoir)
			{{-- si les idSavoir correspondent ajoute les sous savoir --}}
            @if ($unSousSavoir->idSavoir == $unSavoir->idSavoir)
                <tr>
                    <td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S{{$unSousSavoir->idSavoirDetaille}}</font></td>
                    <td align="left" ><font face="Calibri">S{{$unSousSavoir->titreSavoirDetaille}}</font></td>

                    @foreach ($lesCompSousSavoirsCPI as $cpSS)

                        @foreach ($lesCompetencesCPI as $cp)

                            @if ($cpSS->idCompetence == $cp->codeCompetence)
                                <td align="center"><b>x</b></td>
                            @else
                                <td><br></td>
                            @endif

                        @endforeach

                    @endforeach

				</tr>
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
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="29" align="center" ><b><font face="Calibri" size=5>BTS CPRP : Relations principales entre les compétences et les savoirs</font></b></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid ; border-right: 1px solid " colspan=2 height="18" align="center" >COMPETENCES BTS CPRP</td>
		<td  align="center"  bgcolor="#F2DCDB"><b>C1</b></td>
		<td  align="center"  bgcolor="#F2DCDB"><b>C2</b></td>
		<td  align="center"  bgcolor="#F2DCDB"><b>C3</b></td>
		<td  align="center"  bgcolor="#F2DCDB"><b>C4</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C5</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C6</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C7</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C8</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C9</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C10</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C11</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C12</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C13</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C14</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C15</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>C16</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>Cb17</b></td>
		<td  align="center"  bgcolor="#EBF1DE"><b>Cb18</b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">S1 - DEMARCHE DE CONCEPTION ET GESTION DE PROJET</font></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S1.1</font></td>
		<td  align="left" ><font face="Calibri">Ing&eacute;nierie syst&egrave;me et analyse fonctionnelle</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td style="border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S1.2</font></td>
		<td  align="left" ><font face="Calibri">Organisation de l'entreprise industrielle</font></td>
		<td  align="center" ><b><font face="Calibri">x</font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S1.3</font></td>
		<td  align="left" ><font face="Calibri">Comp&eacute;titivit&eacute; des produits industriels</font></td>
		<td  align="center" ><b><font face="Calibri">x</font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">S2 - CHAINE NUMERIQUE</font></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S2.1</font></td>
		<td  align="left" ><font face="Calibri">Concept de &quot;cha&icirc;ne num&eacute;rique&quot;</font></td>
		<td  align="center" ><b><font face="Calibri">x</font></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td style="border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S2.2</font></td>
		<td  align="left" ><font face="Calibri">Simulation</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S2.3</font></td>
		<td  align="left" ><font face="Calibri">Outils de conception et de repr&eacute;sentation num&eacute;riques</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S2.4</font></td>
		<td  align="left" ><font face="Calibri">Repr&eacute;sentations graphiques d&eacute;riv&eacute;es des maquettes num&eacute;riques</font></td>
		<td  align="center" ><b><font face="Calibri">x</font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">S3 - COMPORTEMENT DES SYSTEMES MECANIQUES</font></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S3.1</font></td>
		<td  align="left" ><font face="Calibri">Mod&eacute;lisation des m&eacute;canismes</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S3.2</font></td>
		<td  align="left" ><font face="Calibri">Mouvements relatifs entre solides dans le cas d'une translation ou d'une rotation autour d'un axe fixe</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S3.3</font></td>
		<td  align="left" ><font face="Calibri">Mouvements plans</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S3.4</font></td>
		<td  align="left" ><font face="Calibri">Mod&eacute;lisation des actions m&eacute;caniques</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S3.5</font></td>
		<td  align="left" ><font face="Calibri">Comportement m&eacute;canique des pi&egrave;ces et des syst&egrave;mes</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S3.6</font></td>
		<td  align="left" ><font face="Calibri">R&eacute;sistances des mat&eacute;riaux</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S3.7</font></td>
		<td  align="left" ><font face="Calibri">M&eacute;caniques des fluides</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">S4 - MATERIAUX ET TRAITEMENTS</font></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S4.1</font></td>
		<td  align="left" ><font face="Calibri">Structure et caract&eacute;ristiques des mat&eacute;riaux</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S4.2</font></td>
		<td  align="left" ><font face="Calibri">Domaine d'utilisation des mat&eacute;riaux et leurs traitements</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S4.3</font></td>
		<td  align="left" ><font face="Calibri">Interaction fonction / mat&eacute;riau - g&eacute;om&eacute;trie - proc&eacute;d&eacute; - co&ucirc;t</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">S5 - TECHNOLOGIE DES MECANISMES</font></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S5.1</font></td>
		<td  align="left" ><font face="Calibri">Construction m&eacute;canique</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td style="border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S5.2</font></td>
		<td  align="left" ><font face="Calibri">Conception des porte-pi&egrave;ces et des outillages d'assemblage</font></td>
		<td  align="center" ><b><font face="Calibri">x</font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S5.3</font></td>
		<td  align="left" ><font face="Calibri">Conception des outils et porte-outil</font></td>
		<td  align="center" ><b><font face="Calibri">x</font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">S6 - SPECIFICATION ET PROCESSUS DE CONTR&Ocirc;LE</font></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S6.1</font></td>
		<td  align="left" ><font face="Calibri">Sp&eacute;cifiaction des produits</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S6.2</font></td>
		<td  align="left" ><font face="Calibri">Instruments, outillages et protocoles de contr&ocirc;le</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S6.3</font></td>
		<td  align="left" ><font face="Calibri">Typologie des contr&ocirc;les</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S6.4</font></td>
		<td  align="left" ><font face="Calibri">Qualification des processus de contr&ocirc;le</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">S7 - TECHNOLOGIE DES PROCEDES</font></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S7.1</font></td>
		<td  align="left" ><font face="Calibri">Proc&eacute;d&eacute;s de g&eacute;n&eacute;ration de volumes (premi&egrave;re transformation)</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S7.2</font></td>
		<td  align="left" ><font face="Calibri">Proc&eacute;d&eacute;s de g&eacute;n&eacute;ration de surfaces (deuxi&egrave;me transformation)</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S7.3</font></td>
		<td  align="left" ><font face="Calibri">Proc&eacute;d&eacute;s de g&eacute;n&eacute;ration de volumes (deuxi&egrave;me transformation)</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S7.4</font></td>
		<td  align="left" ><font face="Calibri">Machines</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S7.5</font></td>
		<td  align="left" ><font face="Calibri">Assemblage et parach&egrave;vement</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">S8 - CONCEPTION DE PROCESSUS DE REALISATION</font></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S8.1</font></td>
		<td  align="left" ><font face="Calibri">Strat&eacute;gies</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S8.2</font></td>
		<td  align="left" ><font face="Calibri">Param&egrave;tres de g&eacute;n&eacute;rtation des entit&eacute;s</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S8.3</font></td>
		<td  align="left" ><font face="Calibri">CFAO</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S8.4</font></td>
		<td  align="left" ><font face="Calibri">Qualification des processus</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S8.5</font></td>
		<td  align="left" ><font face="Calibri">M&eacute;thodes d'exp&eacute;rimentation</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S8.6</font></td>
		<td  align="left" ><font face="Calibri">Estimation des co&ucirc;ts des processus</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">S9 - GESTION DE PRODUCTION, QUALITE</font></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S9.1</font></td>
		<td  align="left" ><font face="Calibri">Planification - Ordonnancement</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S9.2</font></td>
		<td  align="left" ><font face="Calibri">Suivi</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S9.3</font></td>
		<td  align="left" ><font face="Calibri">Organisation de la production</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S9.4</font></td>
		<td  align="left" ><font face="Calibri">Qualit&eacute;</font></td>
		<td  align="center" ><b><font face="Calibri">x</font></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">S10 - SECURITE, ERGONOMIE ET ENVIRONNEMENT</font></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S10.1</font></td>
		<td  align="left" ><font face="Calibri">S&eacute;curit&eacute; au travail</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td style="border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S10.2</font></td>
		<td  align="left" ><font face="Calibri">Ergonomie des postes de travail</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S10.3</font></td>
		<td  align="left" ><font face="Calibri">Environnement</font></td>
		<td  align="center" ><b><font face="Calibri"><br></font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b></b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 2px solid " colspan=20 height="18" align="left"  bgcolor="#D9D9D9"><font face="Calibri">S11 - DEMARCHES DE MISE EN &OElig;UVRE DE PROCESSUS</font></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S11.1</font></td>
		<td  align="left" ><font face="Calibri">Cin&eacute;matiques et proc&eacute;d&eacute;s particuliers, d&eacute;marches de mise en &oelig;uvre associ&eacute;es</font></td>
		<td  align="center" ><b><font face="Calibri">x</font></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b>x</b></td>
		<td  align="center" ><b></b></td>
		<td  align="center" ><b></b></td>
		<td style="border-bottom: 1px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border-left: 2px solid ; border-right: 1px solid " height="18" align="center" ><font face="Calibri">S11.2</font></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="left" ><font face="Calibri">D&eacute;marches particuli&egrave;res de contr&ocirc;le des processus</font></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b><font face="Calibri">x</font></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b>x</b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border : 1px solid ; " align="center" ><b></b></td>
		<td style="border-top: 1px solid ; border-bottom: 2px solid ; border-left: 1px solid ; border-right: 2px solid " align="center" ><b>x</b></td>
	</tr>
</table>








      </div>
   </div>
</div>
@endsection
