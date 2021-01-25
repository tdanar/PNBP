@extends('layout')
@section('content')
<div class="clear"></div>
<div class="container">
{{-- <div class="row"> --}}


        @if($privId == 2 || $privId == 5)
        <iframe id="biasa" src="{{env('LHC_MAIN_URL')}}" width="100%" height="600px" frameborder="0"></iframe>
        @else
        <iframe id="admin" src="http://{{Session::get('lhc_url')}}" width="100%" height="800px" frameborder="0" style="overflow: scroll"></iframe>
        @endif


</div>
@push('bottom')

@endpush
@endsection
