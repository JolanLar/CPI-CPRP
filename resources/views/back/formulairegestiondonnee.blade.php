@extends('back/backlayout')


@section('contenu')

    <!-- page container area end -->

    <div class="container">
   <div class="row">
      <div class="col-lg-8 offset-lg-2">
         <h1>Gestion des données</h1>
          <div id="divspace"><br><br><br></div>
          <div id="divsuccess" style="display:none" class="divsucces alert alert-success"></div>
          <div id="divdanger" style="display:none" class="diverreur alert alert-danger"></div>
         @if(session('error'))
         <div id="diverreur" class="diverreur alert alert-danger">{{(session('error')) }}</div>
         @endif
         @if(session('success'))
         <div id="divsucces" class="divsucces alert alert-success">{{session('success')}}</div>
         @endif
         {{ Form::open(array('url' => URL::to('gestiondonnee', array(), true))) }}
         <br>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Filière </label>
               <select class="select form-control"id="lyceefilieredonnee" name="lyceefilieredonnee">
                  @foreach($lesFilieres as $uneFiliere)
                  <option value="{{$uneFiliere->idFiliere}}">
                     {{ $uneFiliere->libelleFiliere }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Compétence détaillée associée : </label>
               <select class="select form-control" name="selectcddonnee" id="selectcddonnee">
                  <option value='-2' disabled>Compétence détaillée</option>
                  @foreach($lesCompetencesDetaillees as $uneCompetenceDetaillee)
                  <option>{{ $uneCompetenceDetaillee->idCompetenceDetaillee }} - {{ $uneCompetenceDetaillee->libelleCompetenceDetaillee }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Donnée associée : </label>
               <select class="select form-control" name="selectcddonneeassociee" id="selectcddonneeassociee">
                  <option value="-1">Nouvelle donnée</option>
                  @foreach($toutesDonnees as $uneDonnee)
                  <option value="{{ $uneDonnee->idDonnee }}">{{ $uneDonnee->idDonnee }} - {{ $uneDonnee->libelleDonnee }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label >Numéro de la donnée :</label>
               <input type="text" name="numdonnee" id="numdonnee">
               <br>
               <label >Description de la donnée :</label>
               <textarea class="form-control" rows="5" name="libelledonnee" id="libelledonnee"></textarea>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="input-group">
               <div class="col-lg-6" >
                  <div class="text-center"><button class="btn btn-success btn-sx" type="submit">Ajouter/Modifier</button></div>
               </div>
               <div class="col-lg-6" >
                  <div class="text-center"><button id="gestiondonneeboutonsupprimer" class="btn btn-danger btn-sx" type="button">Supprimer</button></div>
               </div>
            </div>
         </div>
         <br>
         {{ Form::close() }}
         <br>
      </div>
   </div>
</div>
@endsection
