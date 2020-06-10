@extends('layout')
@section('content')
<div class="clear"></div>
<div class="container">
<div class="row">
    <div class="col-sm-1">&nbsp;</div>
    <div class="col-sm-10"><h2>{{$row->judul}}</h2></div>
    <div class="col-sm-1">&nbsp;</div>
</div>
<div class="row">
    <div class="col-sm-1">&nbsp;</div>
    <div class="col-sm-10">
        {!!$row->isi!!}
    </div>
    <div class="col-sm-1">&nbsp;</div>
</div>
<div class="row">
    <div class="col-sm-1">&nbsp;</div>
    <div class="col-sm-10">
        @if($row->link)
        <p class="text-right"><small>Sumber: <a href="{{$row->link}}">{{$row->link}}</small></p>
        @endif
    </div>
    <div class="col-sm-1">&nbsp;</div>
</div>
</div>
<div class="clear">&nbsp;</div>
@endsection
