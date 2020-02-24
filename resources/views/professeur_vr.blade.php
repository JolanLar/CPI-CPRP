@extends('layout_pr')
@section('contenu')
<div class="container">
   <div class="row principal">
       {{-- Partie Formulaire pour choisir classe / élève / année --}}
       <div class="col-lg-12 liv">
          <div class="container">
              <div class="row">
                  <div class="col-lg-8 offset-lg-2">
                      {{ Form::open(array('url' => URL::to('professeur/vr/detail', array(), true))) }}
                      <br>
                      <div class="col-lg-12">
                          <div class="form-group">
                              <label for="select">Choix de la Classe : </label>
                              <select class="select form-control" id="lyceeclasse" name="lyceeclasse">
                                  @foreach($lesClasses as $uneClasse)
                                      <option value="{{ $uneClasse->idAnneeEtude }}">
                                          {{ $uneClasse->libelleAnneeEtude }}
                                      </option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-lg-12">
                          <div class="form-group">
                              <label for="select">Choix de l'année : </label>
                              <select class="select form-control" id="anneidvr" name="anneidvr">
                                  @foreach($lesAnneesScolaires as $uneAnnee)
                                      <option>
                                          {{ $uneAnnee->annee }}
                                      </option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-lg-12">
                          <div class="form-group">
                              <label for="select">Choix de l'étudiant : </label>
                              <select class="select form-control" id="etudiantidtls" name="etudiantidtls">
                                  @foreach($lesEtudiants as $unEtudiant)
                                      <option value={{$unEtudiant->idUtilisateur}}>
                                          {{ $unEtudiant->idUtilisateur }} : {{ $unEtudiant->Nom }} - {{ $unEtudiant->Prenom }}
                                      </option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-lg-12">
                          <div class="form-group">
                              <button class="btn btn-primary" type="submit">Voir progression <i class="far fa-eye"></i></button>
                          </div>
                      </div>
                      {{ Form::close() }}
                  </div>
              </div>
          </div>
      </div>
</div>
@endsection
