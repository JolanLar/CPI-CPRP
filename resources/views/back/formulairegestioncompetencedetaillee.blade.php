@extends('back/backlayout')


@section('contenu')
    
    <!-- page container area end -->

    <div class="container">
   <div class="row">
      <div class="col-lg-8 offset-lg-2">
         <h1>Gestion des compétences détaillées</h1>
         @if(session('error'))
         <div id="diverreur" class="diverreur alert alert-danger">{{(session('error')) }}</div>
         @endif
         @if(session('success'))
         <div id="divsucces" class="divsucces alert alert-success">{{session('success')}}</div>
         @endif
         {{ Form::open(array('url' => 'gestioncompetencedetaillee')) }}
         <br>  
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Filière :    </label>
               <select class="select form-control" name="lyceefilierecompetencedetaillee" id="lyceefilierecompetencedetaillee">
                  @foreach($lesFilieres as $uneFiliere)
                  <option>
                     {{ $uneFiliere->libelleFiliere }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Compétence détaillée : </label>
               <select class="select form-control" name="selectcompetencedetaillee" id="selectcompetencedetaillee">
                  <option >
                     Nouvelle compétence détaillée
                  </option>
                  @foreach($lesCompetencesDetaillees as $uneCompetenceDetaillee)
                  <option>
                     {{ $uneCompetenceDetaillee->idCompetenceDetaillee }} - {{ $uneCompetenceDetaillee->libelleCompetenceDetaillee }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="input-group mb-2">
               <div class="input-group-prepend">
                  <span class="input-group-text">C</span>
                  <input type="text" class="form-control" name="idlacompetence1" id="idlacompetence1" placeholder="ex : 1" required>
                  <span class="input-group-text">.</span>
                  <input type="text" class="form-control" name="idlacompetence2" id="idlacompetence2" placeholder="ex : 2" required>
               </div>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="comment">Description de la compétence détaillée :</label>
               <textarea class="form-control" rows="5" name="libellelacompetencedetaillee" id="libellelacompetencedetaillee" required></textarea>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="input-group">
               <div class="col-lg-6" >
                  <div class="text-center"><button class="btn btn-success btn-sx" type="submit">Ajouter/Modifier</button></div>
               </div>
               <div class="col-lg-6" >
                  <div class="text-center"><button class="btn btn-danger btn-sx" id="boutonsupprimercompetencedetaillee" type="button">Supprimer</button></div>
               </div>
            </div>
         </div>
         <br>
         {{ Form::close() }}
      </div>
   </div>
</div>

@endsection
