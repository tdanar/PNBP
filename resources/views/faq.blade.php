@extends('layout')
@section('content')
<div class="clear"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-size:30px; font-family:nerismed;">PANDUAN TERKAIT PENGGUNAAN E-MAWAS PNBP</h1>
            <div class="table-responsive">
                <table border="0" cellspacing="0" cellpadding="0" style="border: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="background-color: #003366; color: #fff;"><p align="center"><span style="color: #fff;">NO</span></p></th>
                            <th style="background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">URAIAN</span></p></th>
                            <th style="background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">FILE</span></p></th>
                            <th style="background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">VIDEO</span></p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($panduan_emawas as $index => $value)
                            @php
                                if(($index+1) % 2 == 0){
                                    $back = "background-color: #bababa;";
                                }else{
                                    $back = "background-color: #ededed;";
                                }
                            @endphp
                            <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; {{$back}}"><p>{{$index+1}}.</p></td>
                            <td style="{{$back}}"><b>{{$value->judul}}</b><br/>{{$value->uraian}}</td>
                            <td style="{{$back}}"><center><a href="{{$value->filename_pdf}}?download=1" class="btn btn-primary" target="_blank">Unduh</a></center></td>
                            <td style="{{$back}}"><center><div data-vjs-player>
                                <video id="vid1" class="video-js" controls preload='auto' responsive='true'
                                width='280' height='180' data-setup='{"fluid": true}'>
                                  <source src="{{$value->embed_vid}}">
                                </video></center>
                              </div></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-size:30px; font-family:nerismed;">PANDUAN TERKAIT PENGAWASAN PNBP</h1>
            <div class="table-responsive">
                <table border="0" cellspacing="0" cellpadding="0" style="border: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="background-color: #003366; color: #fff;"><p align="center"><span style="color: #fff;">NO</span></p></th>
                            <th style="background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">URAIAN</span></p></th>
                            <th style="background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">FILE</span></p></th>
                            <th style="background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">VIDEO</span></p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($panduan_pnbp as $index => $value)
                            @php
                                if(($index+1) % 2 == 0){
                                    $back = "background-color: #bababa;";
                                }else{
                                    $back = "background-color: #ededed;";
                                }
                            @endphp
                            <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; {{$back}}"><p>{{$index+1}}.</p></td>
                            <td style="{{$back}}"><b>{{$value->judul}}</b><br/>{{$value->uraian}}</td>
                            <td style="{{$back}}"><center><a href="{{$value->filename_pdf}}?download=1" class="btn btn-primary" target="_blank">Unduh</a></center></td>
                            <td style="{{$back}}"><center><div data-vjs-player>
                                <video id="vid1" class="video-js" controls preload='auto' responsive='true'
                                width='280' height='180' data-setup='{"fluid": true}'>
                                  <source src="{{$value->embed_vid}}">
                                </video></center>
                              </div></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<script>
    const player = videojs('vid1', {});
</script>
@endsection
