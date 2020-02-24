@extends('back/backlayout')


@section('contenu')

<!-- page container area end -->

<div class="container">
   <div class="row">
      <div class="col-lg-8 offset-lg-2">
         <h1>Gestion des savoirs détaillées</h1>
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
               <select class="select form-control" name="lyceefilieresavoirdetaille" id="lyceefilieresavoirdetaille">
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
               <label for="select">Savoirs détaillée : </label>
               <select class="select form-control" name="selectsavoirdetaille" id="selectsavoirdetaille">
                  <option value="-1">
                     Nouveau savoir détaillée
                  </option>
                  @foreach($lesSavoirDetaille as $unSavoirDetaille)
                  @if($unSavoirDetaille->idFiliere==$lesFilieres[0]->idFiliere)
                  <option value="{{ $unSavoirDetaille->idSavoirDetaille }}">
                     {{ $unSavoirDetaille->idSavoirDetaille }} - {{ $unSavoirDetaille->titreSavoirDetaille }}
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
                  <select type="text" class="form-control" name="idlesavoirdetaille1" id="idlesavoirdetaille1" placeholder="ex : 1">
                     <option value="-1">Choix du savoir</option>
                     @foreach($lesSavoirs as $unSavoir)
                     <option value="{{ $unSavoir->idSavoir }}">
                        {{ $unSavoir->idSavoir }}
                     </option>
                     @endforeach
                  </select>
                  <span class="input-group-text">.</span>
                  <input type="text" class="form-control" name="idlesavoirdetaille2" id="idlesavoirdetaille2" placeholder="ex : 2" required>
               </div>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="comment">Titre du savoir détaillée :</label>
               <textarea class="form-control" rows="5" name="titrelesavoirdetaille" id="titrelesavoirdetaille" required></textarea>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="comment">Libelle du savoir détaillée :</label>
               <textarea class="form-control" rows="5" name="libellelesavoirdetaille" id="libellelesavoirdetaille" required></textarea>
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
                  <div class="text-center"><button class="btn btn-success btn-sx" id="boutonajoutersavoirdetaille" type="button">Ajouter/Modifier</button></div>
               </div>
               <div class="col-lg-6">
                  <div class="text-center"><button class="btn btn-danger btn-sx" id="boutonsupprimersavoirdetaille" type="button">Supprimer</button></div>
               </div>
            </div>
         </div>
         <br>
         {{ Form::close() }}
      </div>
   </div>
</div>

@endsection
