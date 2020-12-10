@extends('layout')
@section('content')
<div class="clear"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-size:30px; font-family:nerismed;">PERATURAN TERKAIT PENERIMAAN NEGARA BUKAN PAJAK</h1>
            <div class="table-responsive">
                <table border="0" cellspacing="0" cellpadding="0" style="border: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 43px; background-color: #003366; color: #fff;"><p align="center"><span style="color: #fff;">NO</span></p></th>
                            <th style="width: 762px; background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">URAIAN</span></p></th>
                            <th style="width: 230px; background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">LINK</span></p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peraturan as $index => $value)
                            @php
                                if(($index+1) % 2 == 0){
                                    $back = "background-color: #bababa;";
                                }else{
                                    $back = "background-color: #ededed;";
                                }
                            @endphp
                            <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; {{$back}}"><p>{{$index+1}}.</p></td>
                            <td style="width: 762px; {{$back}}">{{$value->judul}}<br/>{{$value->uraian}}</td>
                            <td style="width: 230px; {{$back}}"><a href="{{$value->link}}"><p align="center">Klik di Sini</p></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection
