@extends('lapAwas')
@section('popover')
    <div class="row">
        <div class="col-xs-3 text-right"><b>Kondisi:</b></div>
        <div class="col-xs-9">{{$row->kondisi}}</div>
    </div>
    <div class="row">
        <div class="col-xs-3 text-right"><b>Sebab:</b></div>
            <div class="col-xs-9">{{$row->sebab}}</div>
    </div>
    <div class="row">
        <div class="col-xs-3 text-right"><b>Akibat:</b></div>
            <div class="col-xs-9">{{$row->akibat}}</div>
    </div>
@stop
