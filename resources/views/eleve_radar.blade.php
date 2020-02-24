@extends('layout_el')

@section('contenu')

    <div class="container">
        <div class="row principal">
            @foreach($lesRadars as $key => $radar)
                <div class="col-lg-12 text-center mt-4">
                    <h4> Radar - {{ $infoEtudiant[$key]->libelleFiliere }}</h4>
                </div>
                <div style="margin-bottom: 70px" class="col-lg-9 offset-lg-2 rad" id="radar">
                    {!! $radar->container() !!}
                    {!! $radar->script() !!}
                </div>
            @endforeach
        </div>

    </div>

@endsection
