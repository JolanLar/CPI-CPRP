@extends('layout_pr')
@section('contenu')
<div class="container">
   <div class="row principal">
      <div class="col-lg-12 liv">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 offset-lg-2">
                  {{ Form::open(array('url' => 'gestionutilisateur')) }}
                  <br>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="select">Choix de la Classe : </label>
                        <select class="select form-control" id="classeid" name="classeid">
                           @foreach($lesClasses as $uneClasse)
                           <option>
                              {{ $uneClasse->libelleAnneeEtude }}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="select">Choix de l'activité : </label>
                        <select class="select form-control" id="activiteid" name="activiteid">
                           <option>
                           </option>
                        </select>
                     </div>
                  </div>
                  <hr/>
                  <br>
                  {{ Form::close() }}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection