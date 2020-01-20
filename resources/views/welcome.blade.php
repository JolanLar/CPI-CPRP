@extends('layout')
@section('contenu')
<div class="container">
   <div class="row fond">
      <br><br><br><br><br><br><br><br>
   </div>
   <div class="row">
      <div class="col-lg-6 offset-lg-3">
         {{ Form::open(array('url' => '/connexion')) }}
         <div class="col-lg-12">
            <div>
               <h1> Connexion</h1>
            </div>
         </div>
         <br>
         @if(session('error'))
         <div id="diverreur" class="diverreur alert alert-danger">{{(session('error')) }}</div>
         @endif
         <div class="col-lg-12">
            <div class="form-group">
               <label for="exampleInputEmail1">Nom d'utilisateur</label>
               <input type="text" class="form-control" id="id" name="idUtilisateur" placeholder="Entrez votre nom d'utilisateur">
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
               <label for="exampleInputEmail1">Mot de passe</label>
               <input type="password" class="form-control" id="mdp" name="mdpUtilisateur" placeholder="Entrez votre mot de passe">
            </div>
         </div>
         <br>
         <div class="col-lg-12">
            <div class="col-lg-4 offset-lg-4">
               <div class="text-center"><button class="btn btn-primary btn-sx" type="submit">Confirmer</button></div>
            </div>
            <br>
            <div class="col-lg-4 offset-lg-4">
               <div class="text-center"><button class="btn btn-secondary btn-sx" type="reset">Réinitialiser</button></div>
            </div>
         </div>
         <br>
         {{ Form::close() }}
      </div>
   </div>
</div>
<br><br><br>
@endsection