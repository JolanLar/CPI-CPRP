@extends('back/backlayout')


@section('contenu')
    
    <!-- page container area end -->

    <div class="container">
   <div class="row">
      <div class="col-lg-8 offset-lg-2">
         <h1>Gestion des indicateurs de performance</h1>
         @if(session('error'))
         <div id="diverreur" class="diverreur alert alert-danger">{{(session('error')) }}</div>
         @endif
         @if(session('success'))
         <div id="divsucces" class="divsucces alert alert-success">{{session('success')}}</div>
         @endif
         {{ Form::open(array('url' => 'gestionindicateurperformance')) }}
         <input type="text" name="ancienlibelle" id="ancienlibelle" hidden>
         <br>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Filière : </label>
               <select class="select form-control" name="lyceefiliereindicateurperformance" id="lyceefiliereindicateurperformance">
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
               <select class="select form-control" name="selectcdindicateurperformance" id="selectcdindicateurperformance">
                  <option disabled>
                     Compétence détaillée
                  </option>
                  @foreach($lesCompetencesDetaillees as $uneCompetenceDetaillee)
                  <option value="{{ $uneCompetenceDetaillee->idCompetenceDetaillee }}">
                     {{ $uneCompetenceDetaillee->idCompetenceDetaillee }} - {{ $uneCompetenceDetaillee->libelleCompetenceDetaillee }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Indicateur de performance : </label>
               <select class="select form-control" name="selectindicateurperformance" id="selectindicateurperformance">
                  <option>
                     Nouvel indicateur de performance
                  </option>
                  @foreach($lesIndicateursPerformance as $unIndicateurPerformance)
                  <option>
                     {{ $unIndicateurPerformance->libelleIndicateurPerformance }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="comment">Description de l'indicateur de performance :</label>
               <textarea class="form-control" rows="5" name="libelleindicateurperformance" id="libelleindicateurperformance" required></textarea>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="input-group">
               <div class="col-lg-6" >
                  <div class="text-center"><button class="btn btn-success btn-sx" type="submit">Ajouter/Modifier</button></div>
               </div>
               <div class="col-lg-6" >
                  <div class="text-center"><button class="btn btn-danger btn-sx" type="button" id="boutonsupprimerindicateur">Supprimer</button></div>
               </div>
            </div>
         </div>
         <br>
         {{ Form::close() }}
      </div>
   </div>
</div>

@endsection
