@extends('layout_pr')
@section('contenu')
<div class="container">
   <div class="row principal">
       {{-- Partie Formulaire pour choisir classe / élève / année --}}
       <div class="col-lg-12 liv">
          <div class="container">
              <div class="row">
                  <div class="col-lg-8 offset-lg-2">
                      {{ Form::open(array('url' => 'professeur/vr')) }}
                      <br>
                      <div class="col-lg-12">
                          <div class="form-group">
                              <label for="select">Choix de la Classe : </label>
                              <select class="select form-control" id="lyceeclasse" name="lyceeclasse">
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
                              <label for="select">Choix de l'année : </label>
                              <select class="select form-control" id="anneidtls" name="anneidtls">
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
                                      <option>
                                          {{ $unEtudiant->idUtilisateur }} : {{ $unEtudiant->Nom }} - {{ $unEtudiant->Prenom }}
                                      </option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      {{ Form::close() }}
                  </div>
              </div>
          </div>
      </div>
       {{-- Partie consultation histogramme / radar / livret --}}
       <div class="col-lg-12">
           <nav>
               <div class="nav nav-tabs" id="nav-tab" role="tablist">
                   <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Histogramme</a>
                   <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Radar</a>
                   <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Livret</a>
               </div>
           </nav>
           <div class="tab-content" id="nav-tabContent">
               <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                   <br>
               </div>
               <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                   <br>
               </div>
               <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                   <br>
                   Le livret
                   <br>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection
