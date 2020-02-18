@extends('back/backlayout')


@section('contenu')

<!-- page container area end -->

<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <h1>Gestion des tâches</h1>
            <div id="divspace"><br><br><br></div>
            <div id="divsuccess" style="display:none" class="divsucces alert alert-success"></div>
            <div id="divdanger" style="display:none" class="diverreur alert alert-danger"></div>
            <div class="card">
                <br>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="select">Choix de la filière :</label>
                        <select name="idFiliere" id="gestiontacheidfiliere" class="select form-control">
                            <option value="-1" disabled>Filière</option>
                            @foreach($filieres as $uneFiliere)
                            <option value="{{$uneFiliere->idFiliere}}">{{$uneFiliere->libelleFiliere}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="select">Choix de l'activité :</label>
                        <select name="idActivite" id="gestiontacheidactivite" class="select form-control">
                            <option value="-1" disabled>Activité</option>
                            @foreach($activites as $uneActivite)
                            <option value="{{$uneActivite->idActivite}}">{{$uneActivite->idActivite}} - {{$uneActivite->libelleActivite}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label for="table">Édition des tâches :</label>
                    <div id="listeTache">
                        @foreach($taches as $uneTache)
                        <br>
                        <table class="table table-bordered">
                            <tr>
                                <td class="id">{{$uneTache->idTache}}</td>
                                <td width="85%" class="tacheText" id="tache-{{$uneTache->idTache}}">{{$uneTache->libelleTache}}</td>
                                <td><a class="tacheEdit" id="{{$uneTache->idTache}}" href="javascript: void(0)"><i class="fas fa-pencil-alt"></i></a></td>
                                <td><a class="tacheDelete text-danger" id="{{$uneTache->idTache}}" href="javascript: void(0)"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        </table>
                        <table class="table-competence table table-bordered">
                            <tr>
                                @foreach($competences as $uneCompetence)
                                <td>{{$uneCompetence->codeCompetence}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($competences as $uneCompetence)
                                <td class="rtc" style="height: 40px;" id="{{$uneTache->idFiliere}}-{{$uneTache->idActivite}}-{{$uneTache->idTache}}-{{$uneCompetence->idCompetence}}">
                                    @foreach($rtc as $unRTC)
                                        @if($unRTC->idCompetence==$uneCompetence->idCompetence&&$uneTache->idTache==$unRTC->idTache)
                                            {{$unRTC->niveau}} 
                                        @endif
                                    @endforeach
                                </td>
                                @endforeach
                            </tr>
                        </table>
                        <br><hr>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="input-group">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <br>
                                <button class="btn btn-success btn-sx" id="gestiontachebtnajouter" type="button">Ajouter/Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

@endsection