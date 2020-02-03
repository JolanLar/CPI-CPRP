@extends('layout_el')

@section('contenu')

    <div class="container">
        <div class="row principal">

            <div class="col-lg-6 offset-lg-3 rad" id="radar">
                {!! $radar->container() !!}
                {!! $radar->script() !!}
            </div>

        </div>

    </div>

@endsection
