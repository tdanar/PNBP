
@extends('crudbooster::admin_template')



@push('bottom')
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/dataRender/datetime.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/dataRender/ellipsis.js"></script>
<script type="text/javascript" src="/scripts/dataTables.rowsGroup.js"></script>

<script>
$(document).ready(function() {
    var unit = {!! json_encode(CRUDBooster::myUnit()) !!};
    var pesanAtas = {!! json_encode($input['tahun'] == ''?'':'Tahun '.$input['tahun'].', ') !!}+
                    {!! json_encode($input['unit'] == ''?'':'Kementerian/Lembaga: '.$input['unit'].', ') !!}+
                    {!! json_encode($input['jenis_was'] == ''?'':'Jenis Pengawasan: '.$input['jenis_was'].', ') !!}+
                    {!! json_encode($input['DeskTemuan'] == ''?'':'Kodefikasi Temuan: '.$input['DeskTemuan'].', ') !!}+
                    {!! json_encode($input['DeskSebab'] == ''?'':'Kodefikasi Sebab: '.$input['DeskSebab'].', ') !!}+
                    {!! json_encode($input['DeskRek'] == ''?'':'Kodefikasi Rekomendasi: '.$input['DeskRek'].', ') !!}+
                    {!! json_encode($input['KodTL'] == ''?'':'Status TL: '.$input['jenis_was']) !!};
    var table = $('#lapawas').DataTable({

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
                    rowsGroup: [0,1],
                    processing: true,
                    searching: true,
                    paging: true,
                    scrollX: true,
                    dom:'B<"col-xs-3 col-xs-offset-9"f>tr<"col-xs-6 col-sm-6"i><"col-xs-6 col-sm-6"p>',
                    buttons: [{
                                    extend: 'excel',
                                    header: true,
                                    messageTop: pesanAtas,
                                    exportOptions: {
                                        columns: [1,2,3,4,5]
                                    }
                                }],
                    columnDefs: [{
                                targets: [6],
                                searchable: false,
                                orderable: false,
                                } ],
                    initComplete: function() {
                                    var $buttons = $('.dt-buttons').hide();
                                    $('#export-ke-excel').on('click', function() {
                                        var btnClass = '.buttons-excel'
                                        $buttons.find(btnClass).click();
                                    });


                                },
                    drawCallback: function ( settings ) {

                                    $('#table-filter2').on('change', function(e){
                                                table.column(5).search(this.value).draw();
                                                e.preventDefault();
                                                });
                                    $('#table-filter3').on('change', function(e){
                                                table.column(9).search(this.value).draw();
                                                e.preventDefault();
                                                });
                                    $('#table-filter-paging').on('change', function(){
                                                val = this.value;
                                                table.page.len(val).draw();
                                                });

                                    $('[data-toggle="popover"]').popover({
                                        trigger: "hover",
                                        container: "body",
                                        placement: "bottom"
                                    });
                                    $('[data-toggle="popover2"]').popover({
                                        trigger: "focus",
                                        animation: true,
                                        container: "table",
                                        placement: "bottom",
                                        delay: { "show": 100, "hide": 100 },
                                        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 style="background-color:green;color:white;" class="popover-title text-uppercase"></h3><div class="popover-content"></div></div>',
                                        html: true
                                    });
                                    //drawCallback(this.api());
                            }
            });

});

    function klikDelete(link) {
         swal({
            title: "Apakah anda yakin ?",
            text: "Anda tidak akan dapat mengembalikan data anda!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ff0000",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            closeOnConfirm: false },
            function(){  location.href=link });
            null;
        };
</script>
@endpush
@section('content')

<div class="col-xs-12 col-sm-12">
<form class="form-horizontal" action="{{ URL::to('/ma/monitoring/') }}">
    {{ csrf_field() }}
<div class="row">
    <div class="col-xs-3 text-right">
        <label>Tahun Pengawasan : </label>
    </div>
    <div class="col-xs-2">
    <select class="form-control" name="tahun">
        <option value="">All</option>
        @foreach($result->unique('tahun')->sortBy('tahun') as $row)
        @if($row->tahun == $input['tahun'])
        <option value="{{$row->tahun}}" selected="selected">{{$row->tahun}}</option>
        @else
        <option value="{{$row->tahun}}">{{$row->tahun}}</option>
        @endif
        @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-xs-3 text-right">
        <label>Kementerian / Lembaga : </label>
    </div>
    <div class="col-xs-2">
    <select class="form-control" name="unit">
        <option value="">All</option>
        @foreach($result->unique('unit')->sortBy('unit') as $row)
            @if($row->unit == $input['unit'])
            <option value="{{$row->unit}}" selected="selected">{{$row->unit}}</option>
            @else
            <option value="{{$row->unit}}">{{$row->unit}}</option>
            @endif
        @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-xs-3 text-right">
        <label>Jenis Pengawasan : </label>
    </div>
    <div class="col-xs-2">
        <select class="form-control" name="jenis_was">
            <option value="">All</option>
            @foreach($result->unique('jenis_awas')->sortBy('jenis_awas') as $row)
                @if($row->jenis_awas == $input['jenis_was'])
                <option value="{{$row->jenis_awas}}" selected="selected">{{$row->jenis_awas}}</option>
                @else
                <option value="{{$row->jenis_awas}}">{{$row->jenis_awas}}</option>
                @endif
            @endforeach
            </select>
    </div>
</div>
<div class="row">
    <div class="col-xs-3 text-right">
        <label>Klasifikasi Temuan : </label>
    </div>
    <div class="col-xs-2">
        <select class="form-control" name="klasTemuan">
            <option value="">All</option>
            @foreach($result->unique('KlasTemuan')->where('KlasTemuan','!=',null)->sortBy('KlasTemuan') as $row)
            @if($row->IdKlasTemuan == $input['klasTemuan'])
                <option value="{{$row->IdKlasTemuan}}" selected="selected">{{$row->KlasTemuan}}</option>
            @else
                <option value="{{$row->IdKlasTemuan}}">{{$row->KlasTemuan}}</option>
            @endif
            @endforeach
            </select>
    </div>
</div>
<div class="row">
    <div class="col-xs-3 text-right">
        <label>Klasifikasi Sebab : </label>
    </div>
    <div class="col-xs-2">
        <select class="form-control" name="klasSebab">
            <option value="">All</option>
            @foreach($result->unique('KlasSebab')->where('KlasSebab','!=',null)->sortBy('KlasSebab') as $row)
                @if($row->IdKlasSebab == $input['klasSebab'])
                    <option value="{{$row->IdKlasSebab}}" selected="selected">{{$row->KlasSebab}}</option>
                @else
                    <option value="{{$row->IdKlasSebab}}">{{$row->KlasSebab}}</option>
                @endif
            @endforeach
            </select>
    </div>
</div>
<div class="row">
    <div class="col-xs-3 text-right">
        <label>Klasifikasi Rekomendasi : </label>
    </div>
    <div class="col-xs-2">
        <select class="form-control" name="klasRek">
            <option value="">All</option>
            @foreach($result->unique('DeskRekomendasi')->where('DeskRekomendasi','!=',null)->sortBy('DeskRekomendasi') as $row)
                @if($row->IdKlasRekomendasi == $input['klasRek'])
                    <option value="{{$row->IdKlasRekomendasi}}" selected="selected">{{$row->DeskRekomendasi}}</option>
                @else
                    <option value="{{$row->IdKlasRekomendasi}}">{{$row->DeskRekomendasi}}</option>
                @endif
            @endforeach
            </select>
    </div>
</div>
<div class="row">
    <div class="col-xs-3 text-right">
        <label>Status Tindak Lanjut : </label>
    </div>
    <div class="col-xs-2">
        <select class="form-control" name="KodTL">
            <option value="">All</option>
            @foreach($result->unique('KodTL')->where('KodTL','!=',null)->sortBy('KodTL') as $row)
                @if($row->KodTL == $input['KodTL'])
                <option value="{{$row->KodTL}}" selected="selected">{{$row->KodTL}}</option>
                @else
                <option value="{{$row->KodTL}}">{{$row->KodTL}}</option>
                @endif
            @endforeach
            </select>
    </div>
</div>

<div class="row">
    <div class="col-xs-3 text-right">
        <label>&nbsp; </label>
    </div>
    <div class="col-xs-2">
        <button type="submit" class="btn btn-default">Tampilkan</button>
    </div>
</div>
</form>
</div>
<div class="row">
    <div class="col-xs-10 text-right">
        <label for="table-filter-paging">Pilih Paging : </label>
    </div>
    <div class="col-xs-2">
        <select id="table-filter-paging">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="-1">All</option>
            </select>
    </div>
</div>
<table id="lapawas" border="1" class="display" style="width:100%">
  <thead>
      <tr style="background-color:#A9A9A9;">
        <th>No.</th>
        <th>Kementerian / Lembaga</th>
        <th>Jenis Pengawasan</th>
        <th>Jumlah Pengawasan</th>
        <th>Jumlah Temuan</th>
        <th>Jumlah Rekomendasi</th>
        <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
      @if ($collection)

          @foreach ($collection as $row)
        <tr>
        <td><center>{{$row->urutan}}</center></td>
        <td>{{$row->unit}}</td>
        <td>{{$row->jenis_awas}}</td>
        <td>{{$row->jml_pengawasan}}</td>
        <td>{{$row->jml_temuan}}</td>
        <td>{{$row->jml_rekomendasi}}</td>
        <td>
        @if (in_array(CRUDBooster::myPrivilegeId(),array(1,3,4)))
        <a class="btn btn-primary" href="/ma/monitoring/dlPDF/{{$row->ID}}" data-toggle="modal" data-target="#dlPDF{{$row->ID}}"><i class="fa fa-file-pdf"></i> Download PDF</a>
        <div id="dlPDF{{$row->ID}}" class="modal fade" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content"><div class="text-center">Memproses...</div>
                        </div>
                    </div>
                </div>
        @elseif(CRUDBooster::myPrivilegeId() == 5 && CRUDBooster::myUnit() == $row->unit)
        <a class="btn btn-primary" href="/ma/monitoring/dlPDF/{{$row->ID}}" data-toggle="modal" data-target="#dlPDF{{$row->ID}}"><i class="fa fa-file-pdf"></i> Download PDF</a>
        <div id="dlPDF{{$row->ID}}" class="modal fade" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content"><div class="text-center">Memproses...</div>
                        </div>
                    </div>
                </div>
        @else
        @endif
        </td>
        </tr>

        @endforeach

      @endif
  </tbody>
</table>

<!-- ADD A PAGINATION -->
<p></p>

@endsection
