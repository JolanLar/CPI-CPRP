@extends('back/backlayout')


@section('contenu')

<!-- page container area end -->
<div class="container">
   <div class="row">
      <div class="col-lg-8 offset-lg-2">
         <h1>Gestion des savoirs</h1>
         @if(session('error'))
         <div id="diverreur" class="diverreur alert alert-danger">{{(session('error')) }}</div>
         @endif
         @if(session('success'))
         <div id="divsucces" class="divsucces alert alert-success">{{session('success')}}</div>
         @endif
         {{ Form::open(array('url' => 'gestionsavoir')) }}
         <br>
         <!-- Menu déroulant des savoirs -->
         <!-- La value des options correspond à -1 par défault ou à l'id du savoir pour le récupérer dans le javascript -->
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Savoir : </label>
               <select class="select form-control" name="selectsavoir" id="selectsavoir">
                  <option value="-1">
                     Nouveau savoir
                  </option>
                  <!-- Parcour lesSavoirs hériter du controller -->
                  @foreach($lesSavoirs as $unSavoir)
                  <option value="{{ $unSavoir->idSavoir }}">
                     {{ $unSavoir->idSavoir }} - {{ $unSavoir->libelleSavoir }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <!-- Zone de texte correspondant à l'id du savoir -->
         <div class="col-lg-12">
            <label class="sr-only" for="inlineFormInputGroup">Savoir</label>
            <div class="input-group mb-2">
               <div class="input-group-prepend">
                  <div class="input-group-text">S.</div>
               </div>
               <input type="text" class="form-control" name="idlesavoir" id="idlesavoir" placeholder="ex : 1" required>
            </div>
         </div>
         <!-- Zone de texte correspondant au libelle du savoir -->
         <div class="col-lg-12">
            <div class="form-group">
               <label for="comment">Description du savoir :</label>
               <textarea class="form-control" rows="5" name="libellelesavoir" id="libellelesavoir" required></textarea>
            </div>
         </div>
         <!-- Bouton de sauvegarde et de suppression -->
         <div class="col-lg-12">
            <div class="input-group">
               <div class="col-lg-6">
                  <div class="text-center"><button class="btn btn-success btn-sx" type="submit">Ajouter/Modifier</button></div>
               </div>
               <div class="col-lg-6">
                  <div class="text-center"><button class="btn btn-danger btn-sx" id="boutonsupprimersavoir" type="button">Supprimer</button></div>
               </div>
            </div>
         </div>
         <br>
         {{ Form::close() }}
      </div>
      <br>
   </div>
</div>
@endsection