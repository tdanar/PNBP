
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
<script>
$(document).ready(function() {
    var unit = {!! json_encode(CRUDBooster::myUnit()) !!};
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
                    order:[[0,'desc'],[1,'desc']],
                    serverSide: true,
                    ajax: {
                                url: '/api/getAwas',
                                type: 'POST'
                            },
                    columns: [
                                        { 'data': 'tahun'},
                                        { 'data': 'tanggal', 'render':  function (data, type, full, meta){
                                            if (data != null && (type === 'display' || type === 'filter')) {
                                                            return new Date(data).toLocaleString("id-ID",{"dateStyle":"long"});
                                                }
                                            return data;
                                        }},
                                        { 'data': 'no_lap'},
                                        { 'data': 'nama_giat_was'},
                                        { 'data': 'jenis_awas'},
                                        { 'data': 'judul',
                                            'render': function (data, type, full, meta) {
                                                if (data != null && (type === 'display' || type === 'filter') ){
                                                    var detil = '<div class="row">'+
                                                                '<div class="col-xs-3 text-right"><b>Kondisi:</b></div>'+
                                                                '<div class="col-xs-9">'+full.kondisi+'</div>'+
                                                            '</div>'+
                                                            '<div class="row">'+
                                                                '<div class="col-xs-3 text-right"><b>Sebab:</b></div>'+
                                                                    '<div class="col-xs-9">'+full.sebab+'</div>'+
                                                            '</div>'+
                                                            '<div class="row">'+
                                                                '<div class="col-xs-3 text-right"><b>Akibat:</b></div>'+
                                                                    '<div class="col-xs-9">'+full.akibat+'</div>'+
                                                            '</div>';
                                                    return  data+'<br/><center><a class="btn btn-xs btn-success" href="javascript:void(0)" role="button" data-toggle="popover2" title="Detil" data-content='+'\''+detil+'\''+'><i class="fa fa-angle-down"></i></a></center>';

                                                }
                                                return data;
                                            }
                                        },
                                        { 'data': 'nilai_uang',
                                            'render': function (data, type, full, meta) {
                                                if(full.nilai_uang != null && (type === 'display' || type === 'filter')){
                                                    return full.KodeMatauang+' '+new Number(full.nilai_uang).toLocaleString("id-ID",{"formatMatcher":"basic"});
                                                }
                                                return data;
                                            }
                                        },
                                        { 'data': 'rekomendasi'},
                                        { 'data': 'KodTL'},
                                        { 'render': function (data, type, full, meta) {
                                                    var mainpath = {!! json_encode(CRUDBooster::mainpath()) !!};
                                                    var temuanpath = {!! json_encode(CRUDBooster::adminPath($slug='lap_awas_temuan')) !!};
                                                    var rekpath = {!! json_encode(CRUDBooster::adminPath($slug='lap_awas_rekomend')) !!};
                                                    var delpath = {!! json_encode(CRUDBooster::mainpath()) !!}+'/delete/'+full.id;
                                                    var verpath = {!! json_encode(CRUDBooster::adminPath()) !!}+'/validasi/'+full.id;
                                                    var begin = "<div class='btn-toolbar' role='toolbar'><div class='btn-group btn-group-xs' role='group'>";
                                                    var end = "</div></div>";
                                                    var penanda = '<span style="color: #ffffff; opacity: 0.0;">'+full.id+'</span>';
                                                    var modalDtl = '<div id="detilmodal'+full.id+'" class="modal fade" role="dialog">'+
                                                                                        '<div class="modal-dialog modal-lg" role="document">'+
                                                                                            '<div class="modal-content">'+
                                                                                                '</div>'+
                                                                                            '</div>'+
                                                                                        '</div>';

                                                    switch (true) {
                                                                case ({!! json_encode(CRUDBooster::isUpdate()) !!}):
                                                                    var button = '<a class="btn btn-success btn-xs btn-block" href="'+mainpath+'/edit/'+full.id+'" role="button" data-toggle="popover" title="Ubah Laporan" data-content="Silahkan mengubah identitas laporan No. '+full.no_lap+' di sini."><i class="fa fa-pen-nib"></i></a>';
                                                                    var button5 = '<a class="btn btn-warning btn-xs btn-block" href="'+verpath+'" role="button" data-toggle="modal" title="Kirim Laporan" data-target="#verifmodal'+full.id+'"><i class="fa fa-paper-plane"></i></a>'+
                                                                                    '<div id="verifmodal'+full.id+'" class="modal fade" role="dialog">'+
                                                                                        '<div class="modal-dialog" role="document">'+
                                                                                            '<div class="modal-content">'+
                                                                                                '</div>'+
                                                                                            '</div>'+
                                                                                        '</div>';



                                                                case ({!! json_encode(CRUDBooster::isView()) !!}):
                                                                var buttonDtl = '<a class="btn btn-primary btn-xs btn-block" href="'+mainpath+'/detail/'+full.id+'" role="button" data-toggle="modal" title="Detil Laporan" data-target="#detilmodal'+full.id+'"><i class="fa fa-eye"></i></a>';

                                                                    var button2 = '<a class="btn btn-info btn-xs btn-block" href="'+temuanpath+'/?return_url='+{!! json_encode(urlencode(Request::fullUrl())) !!}+'&parent_table=t_lap_awas&parent_columns=nama_giat_was,no_lap&parent_columns_alias=Nama Kegiatan,No. Lap&parent_id='+full.id+'&foreign_key=id_lap&label=Temuan" role="button" data-toggle="popover" title="Tambah/Hapus Temuan" data-content="Silahkan mengubah temuan-temuan laporan No. '+full.no_lap+' di sini."><i class="fa fa-plus"></i></a>';
                                                                    var button3 = '<a class="btn btn-success btn-xs btn-block" href="'+rekpath+'/?return_url='+{!! json_encode(urlencode(Request::fullUrl())) !!}+'&parent_table=t_lap_awas_temuan&parent_columns=judul&parent_columns_alias=Judul Temuan&parent_id='+full.id_temuan+'&foreign_key=id_temuan&label=Rekomendasi" role="button" data-toggle="popover" title="Tambah/Hapus Rekomendasi" data-content="Silahkan mengubah rekomendasi-rekomendasi laporan No. '+full.no_lap+' di sini."><i class="fa fa-tasks"></i></a>';


                                                                case ({!! json_encode(CRUDBooster::isDelete()) !!}):
                                                                    var button4 = '<a class="btn btn-danger btn-xs btn-block" href="#" onclick="klikDelete('+'\''+delpath+'\''+')" role="button" data-toggle="popover" title="Hapus Laporan" data-content="Anda dapat menghapus laporan No. '+full.no_lap+' di sini. Penghapusan ini tidak dapat dikembalikan."><i class="fa fa-trash"></i></a>';

                                                                break;

                                                                default:
                                                                    var button = '';
                                                                    var button2 = '';
                                                                    var button3 = '';
                                                                    var button4 = '';
                                                                    var button5 = '';


                                                            };
                                                    if (full.id_status_kirim === "1"){
                                                        // if(!full.id_temuan){
                                                            return button2+button+buttonDtl+button4+button5+penanda+modalDtl;
                                                        /* }else{
                                                            return button2+buttonDtl+button+button4+button5+penanda+modalDtl;
                                                        } */

                                                    }else{
                                                        return buttonDtl+penanda+modalDtl;
                                                    }

                                                    },
                                        'orderable': false,
                                        }
                                    ],
                    processing: true,
                    searching: true,
                    deferRender: true,
                    paging: true,
                    scrollX: true,
                    dom:'B<"col-xs-3 col-xs-offset-9"f>tr<"col-xs-6 col-sm-6"i><"col-xs-6 col-sm-6"p>',
                    buttons: [{
                                    extend: 'excel',
                                    header: true,
                                    messageTop: unit,
                                    exportOptions: {
                                        columns: [0,1,2,3,5,6,7,8],
                                        orthogonal: {
                                            'type': null
                                        }
                                    }
                                }],
                    columnDefs: [ {
                                targets: [2,7],
                                render: $.fn.dataTable.render.ellipsis(20)
                                },{
                                targets: [4],
                                searchable: true,
                                visible: false,
                                } ],
                    initComplete: function() {
                                    var $buttons = $('.dt-buttons').hide();
                                    $('#export-ke-excel').on('click', function() {
                                        var btnClass = '.buttons-excel'
                                        $buttons.find(btnClass).click();
                                    });


                                },
                    drawCallback: function ( settings ) {

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
                                    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                                        e.target // newly activated tab
                                        e.relatedTarget // previous active tab
                                        });
                                    drawCallback(this.api());
                                    $('#table-filter').on('change', function(){
                                                val = this.value;
                                                table.column(0).search(val ? '^'+val+'$' : '', true, false).draw();
                                                });
                                    $('#table-filter2').on('change', function(){
                                                val = this.value;
                                                table.column(4).search(val ? '^'+val+'$' : '', true, false).draw();
                                                });
                                    $('#table-filter3').on('change', function(){
                                                val = this.value;
                                                table.column(8).search(val ? '^'+val+'$' : '', true, false).draw();
                                                });
                            }
            });

});
/*         $(".modal").on("hidden.bs.modal", function(){
            $(".modal-body").html("");
        }); */

    function klikDelete(link) {
         swal({
            title: "Apakah anda yakin menghapus laporan ini?",
            text: "Anda tidak akan dapat mengembalikan data anda!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ff0000",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: false },
            function(){  location.href=link });
            null;
        };

    function klikKirim(link){
        swal({
            title: "Yakin mengirimkan laporan?",
            text: "Anda yakin ingin lanjut mengirimkan laporan ini? Setelah kirim Anda tidak dapat mengubah data laporan lagi.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ff0000",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            closeOnConfirm: false },
            function(){  location.href=link });
            null;
    };




    function drawCallback(api) {
        var info = api.page.info();

        if(info.recordsDisplay != 0){
            var rows = api.rows( {page:'current'} ).nodes(),
            settings = {
                    "COLUMN_THEME" : 0,
                    "COLUMN_SUBTHEME" : 1,
                    "COLUMN_SUBTHEME2" : 2,
                    "COLUMN_SUBTHEME3" : 3,
                    "COLUMN_SUBTHEME4" : 4,
                    "COLUMN_SUBTHEME5" : 5,
                    "COLUMN_THEME2" : 8

            };

                $("#lapawas").find('td').show();
                mergeCells(rows, settings.COLUMN_THEME);
                mergeCells(rows, settings.COLUMN_SUBTHEME);
                mergeCells(rows, settings.COLUMN_SUBTHEME2);
                mergeCells(rows, settings.COLUMN_SUBTHEME3);
                mergeCells(rows, settings.COLUMN_SUBTHEME4);
                mergeCells(rows, settings.COLUMN_SUBTHEME5);
                mergeCells(rows, settings.COLUMN_THEME2);
        }else{
        }

            }
    function mergeCells(rows, rowIndex) {
        var last = null,
                currentRow = null,
                k = null,
                gNum = 0,
                refLine = null;


            rows.each( function (line, i) {
                currentRow = line.childNodes[rowIndex];

                if ( last === currentRow.innerText ) {
                    currentRow.setAttribute('style', 'display: none');
                    ++k;

                    return; //leave early
                }

                last = currentRow.innerText;

                if ( i > 0 ) {
                    rows[refLine].childNodes[rowIndex].rowSpan = ++k;
                    ++gNum;
                }

                k = 0; refLine = i;
            });

            // for the last group
                rows[refLine].childNodes[rowIndex].rowSpan = ++k;





        }


</script>
@endpush
@section('content')
<!-- Your custom  HTML goes here -->
<div class="col-xs-12 col-sm-12">
<div class="form-horizontal">
<div class="row">
    <div class="col-xs-3 text-right">
        <label for="table-filter">Tahun Pengawasan : </label>
    </div>
    <div class="col-xs-2">
    <select id="table-filter">
        <option value="">All</option>
        @foreach($result->unique('tahun') as $row)
        <option>{{$row->tahun}}</option>
        @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-xs-3 text-right">
        <label for="table-filter2">Jenis Pengawasan : </label>
    </div>
    <div class="col-xs-2">
        <select id="table-filter2">
            <option value="">All</option>
            @foreach($result->unique('jenis_awas') as $row)
            <option>{{$row->jenis_awas}}</option>
            @endforeach
            </select>
    </div>
</div>
<div class="row">
    <div class="col-xs-3 text-right">
        <label for="table-filter3">Status Tindak Lanjut :</label>
    </div>
    <div class="col-xs-2">
        <select id="table-filter3">
            <option value="">All</option>
            @foreach($result->unique('KodTL')->where('KodTL','!=',null) as $row)
            <option>{{$row->KodTL}}</option>
            @endforeach
            </select>
    </div>
</div>
</div>
</div>
<table id="lapawas" border="1" class="display" style="width:100%">
  <thead>
      <tr>
        <th title="Tahun Pengawasan">Thn. Pgwsn</th>
        <th title="Tanggal Laporan">Tgl. Lap.</th>
        <th title="Nomor Laporan">No. Lap.</th>
        <th title="Nama Kegiatan Pengawasan">Nama Keg. Pgwsn</th>
        <th>Jenis Pgwsn</th>
        <th title="Judul Temuan">Temuan</th>
        <th title="Nilai Temuan">Nilai</th>
        <th title="Rekomendasi">Rekomendasi</th>
        <th title="Klasifikasi Tindak Lanjut">Status TL</th>
        <th style="width:50px">Aksi</th>
    </tr>
  </thead>
  {{--<tbody>
    @foreach($result as $row)
      <tr>
         <td width="1%" align="center"></td>
        <td>{{$row->tahun}}</td>
        <td data-sort="{{strtotime($row->tanggal)}}">{{date('d M Y', strtotime($row->tanggal))}}</td>
        <td>{{$row->no_lap}}</td>
        <td>{{$row->nama_giat_was}}</td>
        <td>{{$row->judul}}
            <br/>
            @if(!empty($row->judul))
            @php $mydata = '<div class="row">
                <div class="col-xs-3 text-right"><b>Kondisi:</b></div>
                <div class="col-xs-9">'.$row->kondisi.'</div>
            </div>
            <div class="row">
                <div class="col-xs-3 text-right"><b>Sebab:</b></div>
                    <div class="col-xs-9">'.$row->sebab.'</div>
            </div>
            <div class="row">
                <div class="col-xs-3 text-right"><b>Akibat:</b></div>
                    <div class="col-xs-9">'.$row->akibat.'</div>
            </div>';
            @endphp
            <br/><center>
            <a class="btn btn-xs btn-success" href="javascript:void(0)" role="button" data-toggle="popover2" title="Detil" data-content=''><i class="fa fa-angle-down"></i>
            </a>
            </center>
            @endif
        </td>
        <td>{{$row->KodeMatauang.' '.number_format($row->nilai_uang,2,",",".")}}</td>
        <td>{{$row->rekomendasi}}</td>
        <td>{{$row->status_tl}}</td>
        <td width="20%">
          <!-- To make sure we have read access, wee need to validate the privilege -->
          <div class="btn-toolbar" role="toolbar">
          <div class="btn-group btn-group-xs" role="group">
          @if(CRUDBooster::isUpdate() && $button_edit)
          <a class='btn btn-success' href='{{CRUDBooster::mainpath("edit/$row->id")}}' role="button" data-toggle="popover" title="Ubah Laporan" data-content="Silahkan mengubah identitas laporan No. {{$row->no_lap}} di sini."><i class="fa fa-pencil"></i></a>
          @endif
          @if(CRUDBooster::isView() && $button_edit)
          <a class="btn btn-primary" href="{{CRUDBooster::adminPath($slug='lap_awas_temuan').'?return_url='.urlencode(Request::fullUrl()).'&parent_table=t_lap_awas&parent_columns=nama_giat_was,no_lap&parent_columns_alias=Nama Kegiatan,No. Lap&parent_id='.$row->id.'&foreign_key=id_lap&label=Temuan'}}" role="button" data-toggle="popover" title="Tambah/Hapus Temuan" data-content="Silahkan mengubah temuan-temuan laporan No. {{$row->no_lap}} di sini."><i class="fa fa-bars"></i></a>

          @endif
          @if(CRUDBooster::isView() && $button_edit)
          <a class="btn btn-warning" href="{{CRUDBooster::adminPath($slug='lap_awas_rekomend').'?return_url='.urlencode(Request::fullUrl()).'&parent_table=t_lap_awas_temuan&parent_columns=judul&parent_columns_alias=Judul Temuan&parent_id='.$row->id_temuan.'&foreign_key=id_temuan&label=Rekomendasi'}}" role="button" data-toggle="popover" title="Tambah/Hapus Rekomendasi" data-content="Silahkan mengubah rekomendasi-rekomendasi laporan No. {{$row->no_lap}} di sini."><i class="fa fa-bars"></i></a>
          @endif

          @if(CRUDBooster::isDelete() && $button_edit && $row->id_status_kirim === 1)
          <a class='btn btn-danger' href='#' onclick='{{CRUDBooster::deleteConfirm(CRUDBooster::mainpath("delete/$row->id"))}}' role="button" data-toggle="popover" title="Hapus Laporan" data-content="Anda dapat menghapus laporan No. {{$row->no_lap}} di sini. Penghapusan ini tidak dapat dikembalikan."><i class="fa fa-trash"></i></a>
          @endif

          @if(CRUDBooster::isView() && $button_edit)
          <a class="btn btn-success" href="#" role="button" data-toggle="popover" title="Unduh Excel Laporan" data-content="Silahkan mengunduh laporan No. {{$row->no_lap}} di sini."><i class="fa fa-file-excel-o"></i></a>
          @endif

        </div>
        </div>
        <span style="opacity: 0.0;">{{$row->id_temuan}}</span>
        </td>
       </tr>
    @endforeach
  </tbody>--}}
</table>



@endsection
