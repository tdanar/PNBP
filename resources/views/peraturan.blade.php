@extends('layout')
@section('content')
@push('bottom')
<script>
    $(document).ready(function() {
        var table = $('#lapatur').DataTable({
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
            <h1 style="font-size:30px; font-family:nerismed;">PERATURAN TERKAIT PENERIMAAN NEGARA BUKAN PAJAK</h1>
            <div class="table-responsive">
                <table id="lapatur" border="0" cellspacing="0" cellpadding="0" style="border: 0; width: 100%;" class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 43px; background-color: #003366; color: #fff;"><p align="center"><span style="color: #fff;">NO</span></p></th>
                            <th style="width: 762px; background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">URAIAN</span></p></th>
                            <th style="width: 230px; background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">LINK</span></p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peraturan as $index => $value)
                            
                            <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; {{$back}}"><p>{{$index+1}}.</p></td>
                            <td style="width: 762px; {{$back}}">{{$value->judul}}<br/>{{$value->uraian}}</td>
                            <td style="width: 230px; {{$back}}"><a href="{{$value->link}}"><p align="center">Klik di Sini</p></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    <h4>&nbsp;</h4>
            </div>
        </div>
    </div>
</div>
@endsection
