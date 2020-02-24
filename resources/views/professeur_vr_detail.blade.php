@extends('layout_pr')
@section('contenu')
<div class="container">
   <div class="row principal">
    @include('layout_pr_vr')

       @foreach($lesHistogrammes as $key => $histogramme )
            <div class="col-lg-12">
                <h4> Histogramme - {{ $infoEtudiant[$key]->libelleFiliere }}</h4>
            </div>
            <div @if( $key == 0 ) style="margin-bottom: 100px" @endif class="col-lg-12 his" id="histogramme">
                    {!! $histogramme->container() !!}
                    {!! $histogramme->script() !!}
            </div>
       @endforeach
   </div>
</div>
@endsection
