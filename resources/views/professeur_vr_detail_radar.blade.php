@extends('layout_pr')
@section('contenu')
    <div class="container">
        <div class="row principal">
            @include('layout_pr_vr')
            <br>
            <div class="card col-lg-12">
                @foreach($lesRadars as $key => $radar)
                    <div class="text-center mt-4 card-header">
                        <h4> Radar - {{ $infoEtudiant[$key]->libelleFiliere }}</h4>
                    </div>
                    <div style="margin-bottom: 70px" class="offset-2 rad card-body" id="radar">
                        {!! $radar->container() !!}
                        {!! $radar->script() !!}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
