@extends('layout_pr')
@section('contenu')
    <div class="container">
        <div class="row principal">
            @include('layout_pr_vr')
            <br>
                <div class="col-lg-9 offset-lg-2 rad" id="radar">
                    {!! $radar->container() !!}
                    {!! $radar->script() !!}
                </div>
            <br>
        </div>
    </div>
@endsection
