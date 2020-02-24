@extends('layout_el')

@section('contenu')

        <div class="container">
            <div class="row principal">
                @foreach( $lesHistogrammes as $key => $histogramme )
                    <div @if( $key == 0 ) style="margin-top: 50px" @endif class="col-lg-12">
                        <h4> Histogramme - {{ $infoEtudiant[$key]->libelleFiliere }}</h4>
                    </div>
                    <div @if( $key == 0 ) style="margin-bottom: 50px" @endif class="col-lg-12 his" id="histogramme">
                        {!! $histogramme->container() !!}
                        {!! $histogramme->script() !!}
                    </div>
                @endforeach
            </div>
         </div>

@endsection
