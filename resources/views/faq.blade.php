@extends('layout')
@section('content')
@push('bottom')
<script>
    $(document).ready(function() {
        var table1 = $('#penggunaan').DataTable({
            language:
                {
                    sEmptyTable:   "Tidak ada data yang tersedia pada tabel ini",
                    sProcessing:   "Sedang memproses...",
                    sLengthMenu:   "Tampilkan _MENU_ entri",
                    sZeroRecords:  "Tidak ditemukan data yang sesuai",
                    sInfo:         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    sInfoEmpty:    "Menampilkan 0 sampai 0 dari 0 entri",
                    sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
                    sInfoPostFix:  "",
                    sSearch:       "Cari:",
                    sUrl:          "",
                    thousands:     ".",
                    decimal:       ",",
                    oPaginate: {
                        sFirst:    "Pertama",
                        sPrevious: "Sebelumnya",
                        sNext:     "Selanjutnya",
                        sLast:     "Terakhir"
                        }
                },
                searching: true,
                dom:'<"col-xs-3 col-xs-offset-9"f>tr<"col-xs-6 col-sm-6"i><"col-xs-6 col-sm-6"<"pull-right"p>>'
        });
        var table2 = $('#pengawasan').DataTable({
            language:
                {
                    sEmptyTable:   "Tidak ada data yang tersedia pada tabel ini",
                    sProcessing:   "Sedang memproses...",
                    sLengthMenu:   "Tampilkan _MENU_ entri",
                    sZeroRecords:  "Tidak ditemukan data yang sesuai",
                    sInfo:         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    sInfoEmpty:    "Menampilkan 0 sampai 0 dari 0 entri",
                    sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
                    sInfoPostFix:  "",
                    sSearch:       "Cari:",
                    sUrl:          "",
                    thousands:     ".",
                    decimal:       ",",
                    oPaginate: {
                        sFirst:    "Pertama",
                        sPrevious: "Sebelumnya",
                        sNext:     "Selanjutnya",
                        sLast:     "Terakhir"
                        }
                },
                searching: true,
                dom:'<"col-xs-3 col-xs-offset-9"f>tr<"col-xs-6 col-sm-6"i><"col-xs-6 col-sm-6"<"pull-right"p>>'
        });
    });
</script>
@endpush
<div class="clear"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-size:30px; font-family:nerismed;">PANDUAN TERKAIT PENGGUNAAN E-MAWAS PNBP</h1>
            <div class="table-responsive">
                <table border="0" cellspacing="0" cellpadding="0" style="border: 0; width: 100%;" id="penggunaan">
                    <thead>
                        <tr>
                            <th style="background-color: #003366; color: #fff;"><p align="center"><span style="color: #fff;">NO</span></p></th>
                            <th style="background-color: #003366; color: #ffffff; width:40%;"><p align="center"><span style="color: #fff;">URAIAN</span></p></th>
                            <th style="background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">FILE PDF</span></p></th>
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
                            <td style="{{$back}}"><p class="text-justify"><b>{{$value->judul}}</b></p><p class="text-justify" style="white-space: pre-line">{{$value->keterangan}}</p></td>
                            <td style="{{$back}}">
                                <center>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            @if($value->filename_pdf)
                                            <div class="thumbnail">
                                                <a href="{{$value->filename_pdf.'?download=1'}}">
                                                    <img src="{{$value->thumbnail ? $value->thumbnail : '/images/no-image-available.png'}}" style="min-height:175px;max-height:175px;" />
                                                </a>
                                            </div>
                                            @else
                                                <img src="{{$value->thumbnail ? $value->thumbnail : '/images/no-file-available.png'}}" style="min-height:175px;max-height:175px;" />
                                            @endif
                                        </div>
                                    </div>
                                </center>
                            </td>
                            <td style="{{$back}}">
                                <center>
                                    @if(\Illuminate\Support\Str::contains($value->embed_vid,'.mp4'))
                                        <div data-vjs-player>
                                            <video id="vid1" class="video-js" controls preload='auto' responsive='true' width='280' height='180' data-setup='{"fluid": true}'>
                                                <source src="{{$value->embed_vid}}">
                                            </video>
                                        </div>
                                    @else
                                        <iframe src="{{$value->embed_vid}}" width="280" height="180" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> 
                                    @endif
                                </center>
                            </td>
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
                <table border="0" cellspacing="0" cellpadding="0" style="border: 0; width: 100%;" id="pengawasan">
                    <thead>
                        <tr>
                            <th style="background-color: #003366; color: #fff;"><p align="center"><span style="color: #fff;">NO</span></p></th>
                            <th style="background-color: #003366; color: #ffffff; width:40%;"><p align="center"><span style="color: #fff;">URAIAN</span></p></th>
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
                            <td style="{{$back}}"><p class="text-justify"><b>{{$value->judul}}</b></p><p class="text-justify" style="white-space: pre-line">{{$value->keterangan}}</p></td>
                            <td style="{{$back}}">
                                <center>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            @if($value->filename_pdf)
                                            <div class="thumbnail">
                                                <a href="{{$value->filename_pdf.'?download=1'}}">
                                                    <img src="{{$value->thumbnail ? $value->thumbnail : '/images/no-image-available.png'}}" style="min-height:175px;max-height:175px;" />
                                                </a>
                                            </div>
                                            @else
                                                <img src="{{$value->thumbnail ? $value->thumbnail : '/images/no-file-available.png'}}" style="min-height:175px;max-height:175px;" />
                                            @endif
                                        </div>
                                    </div>
                                </center>
                            </td>
                            <td style="{{$back}}">
                                <center>
                                    @if(\Illuminate\Support\Str::contains($value->embed_vid,'.mp4'))
                                        <div data-vjs-player>
                                            <video id="vid1" class="video-js" controls preload='auto' responsive='true' width='280' height='180' data-setup='{"fluid": true}'>
                                                <source src="{{$value->embed_vid}}">
                                            </video>
                                        </div>
                                    @else
                                        <iframe src="{{$value->embed_vid}}" width="280" height="180" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> 
                                    @endif
                                </center>
                            </td>
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
