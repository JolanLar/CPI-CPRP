@extends('back/backlayout')


@section('contenu')

<!-- page container area end -->
<!-- Cet input permet de récupérer la valeur d'ajout d'une nouvelle compétence en javascript -->
<input type="text" style="display:none" id="idAjout" value="{{$idAjout}}">
<div class="container">
   <div class="row">
      <div class="col-lg-8 offset-lg-2 mb-5">
         <h1 clas="titreformu">Création des classes</h1>
         @if(session('error'))
         <div id="diverreur" class="diverreur alert alert-danger">{{(session('error')) }}</div>
         @endif
         @if(session('success'))
         <div id="divsucces" class="divsucces alert alert-success">{{session('success')}}</div>
         @endif
         {{ Form::open(array('url' => URL::to('gestioncreationclasse', array(), true))) }}
         <br>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Choix de la classe :</label>
               <select class="select form-control" id="selectcreationclasse" name="selectcreationclasse">
                  <option value="{{$idAjout}}">
                     Nouvelle classe
                  </option>
                  @foreach($lesClasses as $uneClasse)
                  <option value="{{$uneClasse->idAnneeEtude}}">{{ $uneClasse->libelleAnneeEtude }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <label for="input">Nom de la classe</label>
            <div class="input-group">
               <input type="text" class="form-control" name="idnomclasse" id="idnomclasse" required>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Filière associée :</label>
               <select class="select form-control" id="selectfiliereassociee" name="selectfiliereassociee[]" multiple>
                  @foreach($lesFilieres as $uneFiliere)
                  <option value="{{$uneFiliere->idFiliere}}">
                     {{ $uneFiliere->libelleFiliere }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="input-group">
               <div class="col-lg-6">
                  <div class="text-center"><button class="btn btn-success btn-sx" type="submit">Ajouter</button></div>
               </div>
               <div class="col-lg-6">
                  <div class="text-center"><button class="btn btn-danger btn-sx" id="bouttonsupprimerclasse" type="button">Supprimer</button></div>
               </div>
            </div>
         </div>
         <br>
         <br>
         {{ Form::close() }}
      </div>
   </div>
</div>
@endsection
