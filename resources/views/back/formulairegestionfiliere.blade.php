@extends('back/backlayout')
@section('contenu')

<!-- page container area end -->

<div class="container">
    <div class="row">
        <!-- Tout les mb servent a augmenter la hauteur de la page car sinon le menu deroulant des referentiels est tronqué -->
        <div class="col-lg-8 offset-lg-2 mt-3 mb-5">
            <h1 id="title">Gestion des filières</h1>
            <div class="card mt-5 mb-5">
                <table id="laTable" class="table">
                    @foreach($lesFilieres as $uneFiliere)
                    <tr>
                        <td width="85%" id="filiere-{{$uneFiliere->idFiliere}}">{{$uneFiliere->libelleFiliere}}</td>
                        <td><a class="filiereEdit" id="{{$uneFiliere->idFiliere}}" href="javascript: void(0"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a class="filiereDelete text-danger" id="{{$uneFiliere->idFiliere}}" href="javascript: void(0"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    @endforeach
                </table>
                <div class="row">
                    <div class="col-lg-12 text-center mt-1 mb-3">
                        <button type="button" id="ajoutFiliere" class="btn btn-success">Ajouter une filière</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection