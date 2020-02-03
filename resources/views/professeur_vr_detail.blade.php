@extends('layout_pr')
@section('contenu')
<div class="container">
   <div class="row principal">
    @include('layout_pr_vr')

    <br>
    <div class="col-lg-12 his" id="histogramme">
         {!! $histogramme->container() !!}
              {!! $histogramme->script() !!}
          </div>
   </div>
</div>
@endsection
