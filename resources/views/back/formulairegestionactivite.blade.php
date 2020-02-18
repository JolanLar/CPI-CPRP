@extends('back/backlayout')

@section('contenu')

<div class="container mb-5">
    <div class="row mb-5">
        <div class="col-lg-8 offset-lg-2 mb-5">
            <h1>Gestion des activité</h1>
            <div id="divspace"><br><br><br></div>
            <div id="divsuccess" style="display:none" class="divsucces alert alert-success"></div>
            <div id="divdanger" style="display:none" class="diverreur alert alert-danger"></div>
            <div class="card">
            <br>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="select">Sélectionnez la filière :</label>
                    <select name="idFiliere" id="gestionactiviteidfiliere" class="select form-control">
                        <option value="-1" disabled>Filières</option>
                        @foreach($filieres as $uneFiliere)
                        <option value="{{ $uneFiliere->idFiliere }}">{{$uneFiliere->libelleFiliere}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <label for="table">Édition des tâches :</label>
                <table id="laTable" class="table table-bordered">
                    @foreach($activites as $uneActivite)
                    <tr>
                        <td class="id">{{$uneActivite->idActivite}}</td>
                        <td width="85%" class="text" id="activite-{{$uneActivite->idActivite}}">{{$uneActivite->libelleActivite}}</td>
                        <td><a class="activiteEdit" id="{{$uneActivite->idActivite}}" href="javascript: void(0)"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a class="activiteDelete text-danger" id="{{$uneActivite->idActivite}}" href="javascript: void(0)"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="input-group">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <br>
                            <button class="btn btn-success btn-sx" id="gestionactivitebtnajouter" type="button">Ajouter/Modifier</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection