<!DOCTYPE>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>PDF-LIVRET</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="liv">
    <div class="sticky-table table-filiere" id="{{ $lesDonneesUneFiliere[0]->idFiliere }}">
        <table cellspacing="0" class="table" id="table-{{ $lesDonneesUneFiliere[0]->idFiliere }}" border="0">
            <thead>
            <tr>
                <td style="border: 2px solid #000000;" colspan=63 height="33" align="center" valign=middle bgcolor="#8EB4E3"><b>{{ $lesDonneesUneFiliere[0]->libelleFiliere }}</b></td>
                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD">Expert</td>
                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD">
                    A acquérir
                </td>
                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD">
                    En cours d'acquisition
                </td>
                <td style="border: 2px solid #000000;" colspan=3 rowspan=2 align="center" valign=middle bgcolor="#93CDDD">
                    A renforcer
                </td>
                <td style="border: 2px solid #000000;" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#93CDDD">
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
{{--    Pour chaque indicateur de performance        --}}
            @php ($i=1)
            @foreach($lesDonneesUneFiliere as $uneCCPRP)
                <tr id="ligne1-{{ $uneCCPRP->idIndicateurPerformance }}">
                    <td class="competence" style="border: 3px solid #000000;" height="106" align="center" valign=middle bgcolor="#DBEEF4">C{{$uneCCPRP->idCompetence}} - {{$uneCCPRP->libelleCompetence}}</td>
                    <td class="donnee" style="border: 3px solid #000000;" colspan=17 align="left" valign=middle>{{$uneCCPRP->libelleDonnee}}</td>
                    <td class="competencedet" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=20 align="left" valign=middle>C{{$uneCCPRP->idCompetenceDetaillee}} - {{$uneCCPRP->libelleCompetenceDetaillee}}</td>
                    <td class="indicateur" style="border: 1px solid #000000; border-top: 3px solid #000000;" colspan=25 align="left" valign=middle>{{$uneCCPRP->libelleIndicateurPerformance}}</td>
                    <td class="note" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" colspan=4 align="center" valign=middle><br></td>
{{--    Les cases pour les notes   --}}
                @foreach($tableaunote as $tb)
                    @if($tb->idIndicateurPerformance === $uneCCPRP->idIndicateurPerformance)
{{-- rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr--}}
                        @if($tb->aa === 1)
                            <td class="note aa {{ $tableaunote[$i-1]->idIndicateurPerformance }}" style="border: 3px solid #000000; border-bottom: 1px solid #000000;background-color: rgb(0, 255, 0)" colspan=4 align="center" valign=middle><br></td>
                        @else
                            <td class="note aa" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" colspan=4 align="center" valign=middle><br></td>
                        @endif
{{-- rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr--}}
                        @if($tb->ca1 === 1)
                            <td class="note ca1" style="border: 3px solid #000000; border-bottom: 1px solid #000000;background-color: rgb(0, 255, 0)" colspan=2 align="center" valign=middle><br></td>
                        @else
                            <td class="note ca1" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" colspan=2 align="center" valign=middle><br></td>
                        @endif
{{-- rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr--}}
                        @if($tb->ca2 === 1)
                            <td class="note ca2" style="border: 3px solid #000000; border-bottom: 1px solid #000000;background-color: rgb(0, 255, 0)" colspan=2 align="center" valign=middle><br></td>
                        @else
                            <td class="note ca2" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" colspan=2 align="center" valign=middle><br></td>
                        @endif
{{-- rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr--}}
                        @if($tb->ar1 === 1)
                            <td class="note ar1" style="border: 3px solid #000000; border-bottom: 1px solid #000000;background-color: rgb(0, 255, 0)"  align="center" valign=middle><br></td>
                        @else
                            <td class="note ar1" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" align="center" valign=middle><br></td>
                        @endif
{{-- rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr--}}
                        @if($tb->ar2 === 1)
                            <td class="note ar2" style="border: 3px solid #000000; border-bottom: 1px solid #000000;background-color: rgb(0, 255, 0)"  align="center" valign=middle><br></td>
                        @else
                            <td class="note ar2" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" align="center" valign=middle><br></td>
                        @endif
{{-- rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr--}}
                        @if($tb->ar3 === 1)
                            <td class="note ar3" style="border: 3px solid #000000; border-bottom: 1px solid #000000;background-color: rgb(0, 255, 0)"  align="center" valign=middle><br></td>
                        @else
                            <td class="note ar3" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" align="center" valign=middle><br></td>
                        @endif
{{-- rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr--}}
                        @if($tb->c1 === 1)
                            <td class="note c1" style="border: 3px solid #000000; border-bottom: 1px solid #000000;background-color: rgb(0, 255, 0)"  align="center" valign=middle><br></td>
                        @else
                            <td class="note c1" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" align="center" valign=middle><br></td>
                        @endif
{{-- rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr--}}
                        @if($tb->c2 === 1)
                            <td class="note c2" style="border: 3px solid #000000; border-bottom: 1px solid #000000;background-color: rgb(0, 255, 0)"  align="center" valign=middle><br></td>
                        @else
                            <td class="note c2" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" align="center" valign=middle><br></td>
                        @endif
{{-- rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr--}}
                        @if($tb->c3 === 1)
                            <td class="note c3" style="border: 3px solid #000000; border-bottom: 1px solid #000000;background-color: rgb(0, 255, 0)"  align="center" valign=middle><br></td>
                        @else
                            <td class="note c3" style="border: 3px solid #000000; border-bottom: 1px solid #000000;"  align="center" valign=middle><br></td>
                        @endif
{{-- rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr --}}
                        @if($tb->c4 === 1)
                            <td class="note c4" style="border: 3px solid #000000; border-bottom: 1px solid #000000;background-color: rgb(0, 255, 0)"  align="center" valign=middle><br></td>
                        @else
                            <td class="note c4" style="border: 3px solid #000000; border-bottom: 1px solid #000000;" align="center" valign=middle><br></td>
                        @endif
                    @endif
                @endforeach
                </tr>
                @php ($i++)
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('../resources/js/jquery.stickyTableHeader.js') }}"></script>
<script type="text/javascript" src="{{ asset('../resources/js/professeurtableau.js') }}"></script>
</body>
</html>

