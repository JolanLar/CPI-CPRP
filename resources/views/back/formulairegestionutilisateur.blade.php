@extends('back/backlayout')


@section('contenu')

    <!-- page container area end -->

   <div class="container">
   <div class="row">
      <div class="col-lg-8 offset-lg-2">
         <h1 clas="titreformu">Gestion des utilisateurs</h1>
         @if(session('error'))
         <div id="diverreur" class="diverreur alert alert-danger">{{(session('error')) }}</div>
         @endif
         @if(session('success'))
         <div id="divsucces" style="white-space: pre-wrap;" class="divsucces alert alert-success">{{session('success')}}</div>
         @endif
         {{ Form::open(array('url' => URL::to('gestionutilisateur', array(), true))) }}
         <br>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="select">Choix de l'utilisateur </label>
               <select class="select form-control" id="selectutilisateur"  name="selectutilisateur">
                  <option>
                     Nouvel utilisateur
                  </option>
                  @foreach($lesUtilisateurs as $unUtilisateur)
                  <option  >
                     {{ $unUtilisateur->idUtilisateur }} : {{ $unUtilisateur->Nom }} - {{ $unUtilisateur->Prenom }}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label>Nom</label>
               <input type="text" class="form-control" name="nomutilisateur" id="nomutilisateur" placeholder="Entrez le nom de l'utilisateur" required>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label>Prénom</label>
               <input type="text" class="form-control" name="prenomutilisateur" id="prenomutilisateur"  placeholder="Entrez le prénom de l'utilisateur" required>
            </div>
         </div>
         <div class="col-lg-12">
            <label>Rôle</label><br>
            <select class="select form-control" name="etudiantrole" id="etudiantrole">
               <option value="Etudiant" >Etudiant</option>
               <option value="Professeur">Professeur</option>
               <option value="Administrateur">Administrateur</option>
            </select>
         </div>
         <br>
         <div class="col-lg-12">
            <div class="input-group">
               <div class="col-lg-6" >
                  <div class="text-center"><button class="btn btn-success btn-sx" type="submit">Ajouter/Modifier</button></div>
               </div>
               <div class="col-lg-6" >
                  <div class="text-center" ><button class="btn btn-danger btn-sx" id="boutonsupprimerutilisateur" type="button">Supprimer</button></div>
               </div>
            </div>
             * Ne pas oublier de sauvegarder le mot de passe
         </div>
         <br>

         {{ Form::close() }}
      </div>
   </div>
</div>
@endsection
