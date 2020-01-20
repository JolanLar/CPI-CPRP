@extends('layout_pr')
@section('contenu')
<div class="container">
   <div class="row principal">
      <div class="col-lg-12 liv">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 offset-lg-2">
                  {{ Form::open(array('url' => 'gestionutilisateur')) }}
                  <br>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="select">Choix de la classe </label>
                        <select class="select" id="classe">
                           <option>
                              c
                           </option>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="select">Choix de l'activité </label>
                        <select class="select" id="activité">
                           <option>
                              Nouvelle activité
                           </option>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label>Nom de l'activité</label>
                        <input type="text" class="form-control" id="nomact" placeholder="Entrez le nom de l'activité">
                     </div>
                  </div>
                  <hr />
                  <div class="col-lg-12">
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label>N° de la comp. evaluée</label>
                           <input type="text" class="form-control" id="numcomp" placeholder="" disabled="true" value='{{ $i }}'>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="select">Compétence</label>
                        <select class="select" id="comp">
                           <option>
                              c
                           </option>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="select">Compétence détaillée </label>
                        <select class="select" id="compd">
                           <option>
                              cd
                           </option>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="input-group">
                        <div class="col-lg-1" >
                           <div class="text-center"><button class="btn btn-primary btn-sx" id="plus" type="button">+</button></div>
                        </div>
                        <div class="col-lg-1" >
                           <div class="text-center"><button class="btn btn-primary btn-sx" id="moins" type="button">-</button></div>
                        </div>
                        <div class="col-lg-10" >
                           <div class="text-center"><button class="btn btn-danger btn-sx" type="button">Supprimer</button></div>
                        </div>
                     </div>
                  </div>
                  <hr />
                  <div class="col-lg-12">
                     <div class="input-group">
                        <div class="col-lg-6" >
                           <div class="text-center"><button class="btn btn-primary btn-sx" type="submit">Ajouter/Modifier</button></div>
                        </div>
                        <div class="col-lg-6" >
                           <div class="text-center"    ><button class="btn btn-danger btn-sx" type="button">Supprimer</button></div>
                        </div>
                     </div>
                  </div>
                  <br>
                  {{ Form::close() }}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection