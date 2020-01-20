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
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Filière : </label>
               <select class="select" id="lyceefilieresavoir" name="lyceefilieresavoir">
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
               <label for="select">Savoir : </label>
               <select class="select" name="selectcompetence" id="selectcompetence">
                  <option >
                     Nouveau savoir
                  </option>
                  @foreach($lesSavoirs as $unSavoir)
                  <option>
                     {{ $unSavoir->idSavoir }} - {{ $unSavoir->libelleSavoir }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <label class="sr-only" for="inlineFormInputGroup">Savoir</label>
            <div class="input-group mb-2">
               <div class="input-group-prepend">
                  <div class="input-group-text">S.</div>
               </div>
               <input type="text" class="form-control"  name="idlesavoir" id="idlesavoir" placeholder="ex : 1" required>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="comment">Description du savoir :</label>
               <textarea class="form-control" rows="5" name="libellelesavoir" id="libellelesavoir" required></textarea>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="input-group">
               <div class="col-lg-6" >
                  <div class="text-center"><button class="btn btn-success btn-sx" type="submit">Ajouter/Modifier</button></div>
               </div>
               <div class="col-lg-6" >
                  <div class="text-center" ><button class="btn btn-danger btn-sx" id="boutonsupprimercompetence" type="button">Supprimer</button></div>
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
