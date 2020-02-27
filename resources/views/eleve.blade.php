@extends('layout_el')

@section('contenu')

        <div class="container">
            <div class="row principal">
                <div class="card col-lg-12">
                    @foreach( $lesHistogrammes as $key => $histogramme )
                        <div @if($key == 0) style="margin-top: 20px;" @endif class="card-header text-center">
                            <h5> Histogramme - {{ $infoEtudiant[$key]->libelleFiliere }}</h5>
                        </div>
                        <div class="his card-body" id="histogramme">
                            {!! $histogramme->container() !!}
                            {!! $histogramme->script() !!}
                        </div>
                    @endforeach
                </div>
            </div>
         </div>

@endsection
