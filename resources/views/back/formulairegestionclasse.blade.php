@extends('back/backlayout')


@section('contenu')

    <!-- page container area end -->

<div class="container">
   <div class="row">
      <div class="col-lg-8 offset-lg-2">
         <h1 clas="titreformu">Gestion des classes</h1>
         @if(session('error'))
         <div id="diverreur" class="diverreur alert alert-danger">{{(session('error')) }}</div>
         @endif
         @if(session('success'))
         <div id="divsucces" class="divsucces alert alert-success">{{session('success')}}</div>
         @endif
         {{ Form::open(array('url' => 'gestionclasse')) }}
         <br>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Choix de la classe :</label>
               <select class="select form-control" id="selectgestionclasse" name="selectgestionclasse">
                  <option value="-2"disabled>
                     Classe
                  </option>
                  @foreach($lesClasses as $uneClasse)
                  <option value="{{$uneClasse->idAnneeEtude}}">
                     {{ $uneClasse->libelleAnneeEtude }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Choix de l'élève :</label>
               <select class="select form-control" id="selectgestionutilisateur"  name="selectgestionutilisateur">
                  @foreach($lesEtudiants as $unEtudiant)
                  <option>
                     {{ $unEtudiant->idUtilisateur }} : {{ $unEtudiant->Nom }} - {{ $unEtudiant->Prenom }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Choix de l'année:</label>
               <select class="select form-control" id="selectgestionclasseannee"  name="selectgestionclasseannee">
                  @foreach($lesAnnees as $uneAnnee)
                  <option>
                     {{ $uneAnnee->annee }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="input-group">
               <div class="col-lg-6 offset-lg-3" >
                  <div class="text-center"><button class="btn btn-success btn-sx" type="submit">Ajouter</button></div>
               </div>
            </div>
         </div>
         <br>
         <div class="col-lg-12">
            <h3 name="etudiantclasse" id="etudiantclasse" >Liste des élèves de la classe :</h3>
            <table class="table">
               <thead class="thead" style="background: #2980b9; color: white;">
                  <tr>
                     <th scope="col">Login</th>
                     <th scope="col">Nom</th>
                     <th scope="col">Prenom</th>
                     <th scope="col"></th>
                  </tr>
               </thead>
               <tbody name="tableauetudiant" id="tableauetudiant">
               </tbody>
            </table>
         </div>
         <br>
         <br>
         {{ Form::close() }}
      </div>
   </div>
</div>
@endsection
