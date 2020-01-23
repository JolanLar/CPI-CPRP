@extends('layout_el')

@section('contenu')

        <div class="container">
            <div class="row principal">
                <div class="col-lg-12 his" id="histogramme">
                    {!! $histogramme->container() !!}
                    {!! $histogramme->script() !!}
                </div>
            </div>
         </div>

@endsection
