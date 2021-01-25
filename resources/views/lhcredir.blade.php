@extends('layout')
@section('content')
<div class="clear"></div>
<div class="container">
    <center><h3 class="text-primary"><em>Mohon tunggu sebentar...</em></h3><br/>

        <iframe class="holds-the-iframe" width="100%" height="300px" frameborder="0">

        </iframe></center>


</div>
@push('bottom')
<script>
    setTimeout(function(){
       window.location.href = {!! json_encode($url) !!};
    }, 10);
 </script>
@endpush
@endsection
