@extends('back/backlayout')


@section('contenu')

<!-- page container area end -->

<div class="container">
   <div class="row">
      <div class="col-lg-8 offset-lg-2">
         <h1>Gestion des sous savoirs détaillées</h1>
         @if(session('error'))
         <div id="diverreur" class="diverreur alert alert-danger">{{(session('error')) }}</div>
         @endif
         @if(session('success'))
         <div id="divsucces" class="divsucces alert alert-success">{{session('success')}}</div>
         @endif
         {{ Form::open(array('url' => URL::to('gestionsavoirdetaille', array(), true))) }}
         <br>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Filière : </label>
               <select class="select form-control" name="lyceefilieresoussavoirdetaille" id="lyceefilieresoussavoirdetaille">
                  <option value="-1" disabled>
                     Filière
                  </option>
                  @foreach($lesFilieres as $uneFiliere)
                  <option value="{{ $uneFiliere->idFiliere }}">
                     {{ $uneFiliere->libelleFiliere }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Sous savoirs détaillée : </label>
               <select class="select form-control" name="selectsoussavoirdetaille" id="selectsoussavoirdetaille">
                  <option value="-1">
                     Nouveau sous savoir détaillé
                  </option>
                  @foreach($lesSousSavoirDetaille as $unSousSavoirDetaille)
                  @if($unSousSavoirDetaille->idFiliere==$lesFilieres[0]->idFiliere)
                  <option value="{{ $unSousSavoirDetaille->idSousSavoirDetaille }}">
                     {{ $unSousSavoirDetaille->idSousSavoirDetaille }} - {{ $unSousSavoirDetaille->titreSousSavoirDetaille }}
                  </option>
                  @endif
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="input-group mb-2">
               <div class="input-group-prepend">
                  <span class="input-group-text">S</span>
                  <select type="text" class="form-control" name="idlesoussavoirdetaille1" id="idlesoussavoirdetaille1" placeholder="ex : 1">
                     <option value="-1">Choix du savoir detaille</option>
                     @foreach($lesSavoirsDetaille as $unSavoirDetaille)
                     @if($unSavoirDetaille->idFiliere==$lesFilieres[0]->idFiliere)
                     <option value="{{ $unSavoirDetaille->idSavoirDetaille }}">
                        {{ $unSavoirDetaille->idSavoirDetaille }}
                     </option>
                     @endif
                     @endforeach
                  </select>
                  <span class="input-group-text">.</span>
                  <input type="text" class="form-control" name="idlesoussavoirdetaille2" id="idlesoussavoirdetaille2" placeholder="ex : 2" required>
               </div>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="comment">Titre du sous savoir détaillé :</label>
               <textarea class="form-control" rows="5" name="titrelesoussavoirdetaille" id="titrelesoussavoirdetaille" required></textarea>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="comment">Libelle du sous savoir détaillé :</label>
               <textarea class="form-control" rows="5" name="libellelesoussavoirdetaille" id="libellelesoussavoirdetaille" required></textarea>
            </div>
         </div>
         @foreach($lesFilieres as $i => $uneFiliere)
         <div class="col-lg-12 comp" id="{{$uneFiliere->idFiliere}}">
            <h4>{{ $uneFiliere->libelleFiliere }}</h4>
            @foreach($lesCompetences[$i] as $uneCompetence)
            <div class="form-check form-check-inline">
               <input class="form-check-input competence" style="width: 20px; height: 20px;" type="checkbox" id="{{$uneFiliere->idFiliere}}-{{ $uneCompetence->idCompetence }}">
               <label class="form-check-label" for="{{ $uneCompetence->idCompetence }}">{{ $uneCompetence->codeCompetence }}</label>
            </div>
            @endforeach
         </div>
         @endforeach
         <div class="col-lg-12">
            <div class="input-group">
               <div class="col-lg-6">
                  <div class="text-center"><button class="btn btn-success btn-sx" id="boutonajoutersoussavoirdetaille" type="button">Ajouter/Modifier</button></div>
               </div>
               <div class="col-lg-6">
                  <div class="text-center"><button class="btn btn-danger btn-sx" id="boutonsupprimersoussavoirdetaille" type="button">Supprimer</button></div>
               </div>
            </div>
         </div>
         <br>
         {{ Form::close() }}
      </div>
   </div>
</div>

@endsection
