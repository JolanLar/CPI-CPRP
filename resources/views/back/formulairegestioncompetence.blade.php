@extends('back/backlayout')


@section('contenu')
    
    <!-- page container area end -->

    <div class="container">
   <div class="row">
      <div class="col-lg-8 offset-lg-2">
         <h1>Gestion des compétences</h1>
         @if(session('error'))
         <div id="diverreur" class="diverreur alert alert-danger">{{(session('error')) }}</div>
         @endif
         @if(session('success'))
         <div id="divsucces" class="divsucces alert alert-success">{{session('success')}}</div>
         @endif
         {{ Form::open(array('url' => 'gestioncompetence')) }}
         <br>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Filière : </label>
               <select class="select form-control" id="lyceefilierecompetence" name="lyceefilierecompetence">
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
               <label for="select">Compétence : </label>
               <select class="select form-control" name="selectcompetence" id="selectcompetence">
                  <option value="-1">
                     Nouvelle compétence
                  </option>
                  @foreach($lesCompetences as $uneCompetence)
                  <option value="{{ $uneCompetence->idCompetence }}">{{ $uneCompetence->idCompetence }} - {{ $uneCompetence->libelleCompetence }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <label class="sr-only" for="inlineFormInputGroup">Compétence</label>
            <div class="input-group mb-2">
               <div class="input-group-prepend">
                  <div class="input-group-text">C.</div>
               </div>
               <input type="text" class="form-control"  name="idlacompetence" id="idlacompetence" placeholder="ex : 1" required>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="comment">Description de la compétence :</label>
               <textarea class="form-control" rows="5" name="libellelacompetence" id="libellelacompetence" required></textarea>
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
