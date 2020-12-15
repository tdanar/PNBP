
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

                                        { 'data': 'unit'},

                                        { 'data': 'tanggal', 'render':  function (data, type, full, meta){
                                            if (data != null && (type === 'display' || type === 'filter')) {
                                                let options = { year: 'numeric', month: 'long', day: 'numeric' };
                                                            return new Date(data).toLocaleString("id-ID",options);
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

                                        {'data': 'DeskTemuan'},
                                        {'data': 'kondisi'},

                                        { 'data': 'nilai_uang',
                                            'render': function (data, type, full, meta) {
                                                if(full.nilai_uang != null && (type === 'display' || type === 'filter')){
                                                    return full.KodeMatauang+' '+full.nilai_uang.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                                }
                                                return data;
                                            }
                                        },

                                        {'data': 'sebab'},
                                        {'data': 'DeskSebab'},
                                        {'data': 'akibat'},

                                        { 'data': 'rekomendasi'},

                                        {'data': 'DeskRekomendasi'},
                                        {'data': 'tl'},


                                        { 'data': 'KodTL','render': function (data, type, full, meta) {
                                           if(full.KodTL == 'Sesuai'){
                                               return '<div class="btn btn-success btn-circle" title="Sesuai"></div>'
                                           }else if(full.KodTL == 'Belum Sesuai'){
                                            return '<div class="btn btn-warning btn-circle" title="Belum Sesuai"></div>'
                                            }else if(full.KodTL == 'Tidak dapat ditindaklanjuti'){
                                                return '<div class="btn btn-black btn-circle" title="Tidak dapat ditindaklanjuti"></div>'
                                            }else if(full.KodTL == 'Belum Ditindaklanjuti'){
                                                return '<div class="btn btn-danger btn-circle" title="Belum Ditindaklanjuti"></div>'
                                           }else{
                                                return '<div class="btn btn-primary btn-circle" title="Tidak Ada Rekomendasi"></div>'
                                           }
                                        }},
                                        { 'render': function (data, type, full, meta) {
                                                    var myId = {!! json_encode(CRUDBooster::myPrivilegeId()) !!};
                                                    var mainpath = {!! json_encode(CRUDBooster::mainpath()) !!};
                                                    var temuanpath = {!! json_encode(CRUDBooster::adminPath($slug='lap_awas_temuan')) !!};
                                                    var rekpath = {!! json_encode(CRUDBooster::adminPath($slug='lap_awas_rekomend')) !!};
                                                    var delpath = {!! json_encode(CRUDBooster::mainpath()) !!}+'/delete/'+full.id;
                                                    var addpath = {!! json_encode(CRUDBooster::mainpath()) !!}+'/addTL/'+full.id;
                                                    var verpath = {!! json_encode(CRUDBooster::adminPath()) !!}+'/validasi/'+full.id;
                                                    var revpath = {!! json_encode(CRUDBooster::adminPath()) !!}+'/reviu/'+full.id;
                                                    var batalpath = {!! json_encode(CRUDBooster::adminPath()) !!}+'/batal/'+full.id;
                                                    var begin = "<div class='btn-toolbar' role='toolbar'><div class='btn-group btn-group-xs' role='group'>";
                                                    var end = "</div></div>";
                                                    var penanda = '<span style="color: #ffffff; opacity: 0.0;">'+full.id+'</span>';

                                                    switch (true) {
                                                                case ({!! json_encode(CRUDBooster::isUpdate()) !!}):
                                                                    var button = '<a class="btn btn-success btn-xs btn-block" href="'+addpath+'" role="button" data-toggle="modal" title="Tindak Lanjut" data-target="#addTl'+full.id+'"><i class="fa fa-pen-nib"></i></a>'+
                                                                                    '<div id="addTl'+full.id+'" class="modal fade" role="dialog">'+
                                                                                        '<div class="modal-dialog modal-lg" role="document">'+
                                                                                            '<div class="modal-content"><div class="text-center">Memproses...</div>'+
                                                                                                '</div>'+
                                                                                            '</div>'+
                                                                                        '</div>';

                                                                case ({!! json_encode(CRUDBooster::isView()) !!}):

                                                                case ({!! json_encode(CRUDBooster::isDelete()) !!}):

                                                                break;

                                                                default:
                                                                    var button = '';


                                                            };
                                                    if(full.id_rekomendasi !== null){
                                                        return button+penanda;
                                                    }else{
                                                        return penanda;
                                                    }


                                                    },
                                        'orderable': false,
                                        },
                                        {'data':'inputer'},
                                        {'data':'id_status_kirim'}
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
                                        columns: [' :not(:last-child)'],
                                        orthogonal: {
                                            'type': null
                                        }
                                    }
                                }],
                    columnDefs: [{
                                targets: [3,13],
                                render: $.fn.dataTable.render.ellipsis(40)
                                },{
                                targets: [1,5,7,8,10,11,12,14,15,18,19],
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

                                    drawCallback(this.api());
                                    $('#table-filter').on('change', function(){
                                                val = this.value;
                                                table.column(0).search(val ? '^'+val+'$' : '', true, false).draw();
                                                });
                                    $('#table-filter2').on('change', function(){
                                                val = this.value;
                                                table.column(5).search(val ? '^'+val+'$' : '', true, false).draw();
                                                });
                                    $('#table-filter3').on('change', function(){
                                                val = this.value;
                                                table.column(16).search(val ? '^'+val+'$' : '', true, false).draw();
                                                });
                                    $('#table-filter4').on('change', function(){
                                                val = this.value;
                                                table.column(19).search(val ? '^'+val+'$' : '', true, false).draw();
                                                });
                                    $('#table-filter-unit').on('change', function(){
                                                val = this.value;
                                                table.column(1).search(val).draw();
                                                });
                                    $('#table-filter-temuan').on('change', function(){
                                                val = this.value;
                                                table.column(7).search(val).draw();
                                                });
                                    $('#table-filter-sebab').on('change', function(){
                                                val = this.value;
                                                table.column(11).search(val).draw();
                                                });
                                    $('#table-filter-rekomend').on('change', function(){
                                                val = this.value;
                                                table.column(14).search(val).draw();
                                                });
                                    $('#table-filter-paging').on('change', function(){
                                                val = this.value;
                                                table.page.len(val).draw();
                                                });
                            }
            });

            $(document.body).on('hide.bs.modal', function (e) {
                                            //divid = '#'+e.target.id;
                                            //$(e.target).removeData('bs.modal');
                                            table.draw(false);

        });

});


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
            title: "Anda yakin ingin lanjut mengirimkan laporan ini ke approver Anda? ",
            text: "Setelah Kirim, Anda tidak dapat mengubah data laporan lagi",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f39c12",
            confirmButtonText: "Kirim",
            cancelButtonText: "Batal",
            closeOnConfirm: false },
            function(){  location.href=link });
            null;
    };

    function klikTolak(id){
        var formData = $('#form'+id).serialize();
        //console.log(formData);
        swal({
            title: "Anda yakin ingin menolak laporan ini? ",
            text: "Setelah Ditolak, laporan harus dikirim ulang oleh inputer Anda",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f39c12",
            confirmButtonText: "Tolak",
            cancelButtonText: "Batal",
            closeOnConfirm: false },
            function(){
                location.href='/ma/rev?'+formData;
             });
            null;
    };

    function klikSetuju(id){
        var formData = $('#form'+id).serialize();
        swal({
            title: "Anda yakin ingin menyetujui laporan ini? ",
            text: "Setelah Disetujui, laporan terkirim ke Kementerian Keuangan dan tidak dapat diubah lagi.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f39c12",
            confirmButtonText: "Setuju",
            cancelButtonText: "Batal",
            closeOnConfirm: false },
            function(){
                location.href='/ma/rev?'+formData;
                });
            null;
    };

    function klikBatal(link){
        swal({
            title: "Anda yakin ingin membatalkan pengiriman laporan ini? ",
            text: "Setelah klik Ya, Pengguna wajib mengirimnya kembali",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f39c12",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            closeOnConfirm: false },
            function(){  location.href=link });
            null;
    };




    function drawCallback(api) {
        var info = api.page.info();
        var last = (api.columns(':visible')[0].length)-1;
        //console.log(api.columns());
        if(info.recordsDisplay != 0){
            var rows = api.rows( {page:'current'} ).nodes(),
            settings = {
                    "COLUMN_THEME" : 0,
                    "COLUMN_SUBTHEME" : 1,
                    "COLUMN_SUBTHEME2" : 2,
                    "COLUMN_SUBTHEME3" : 3,
                    "COLUMN_SUBTHEME4" : 4,
                    "COLUMN_SUBTHEME5" : 5,
                    "COLUMN_THEME2" : last

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
    @if(CRUDBooster::isSuperadmin() || CRUDBooster::myPrivilegeId() == 3 || CRUDBooster::myPrivilegeId() == 4 || CRUDBooster::myPrivilegeId() == 5)
    @if(CRUDBooster::myPrivilegeId() != 5)
    <div class="row">
        <div class="col-xs-3 text-right">
            <label for="table-filter-unit">Kementerian / Lembaga : </label>
        </div>
        <div class="col-xs-2">
            <select id="table-filter-unit">
                <option value="">All</option>
                @foreach($result->unique('unit') as $row)
                <option>{{$row->unit}}</option>
                @endforeach
                </select>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-xs-3 text-right">
            <label for="table-filter-temuan">Klasifikasi Temuan : </label>
        </div>
        <div class="col-xs-2">
            <select id="table-filter-temuan">
                <option value="">All</option>
                @foreach($result->unique('DeskTemuan')->where('DeskTemuan','!=',null) as $row)
                <option>{{$row->DeskTemuan}}</option>
                @endforeach
                </select>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3 text-right">
            <label for="table-filter-sebab">Klasifikasi Sebab : </label>
        </div>
        <div class="col-xs-2">
            <select id="table-filter-sebab">
                <option value="">All</option>
                @foreach($result->unique('DeskSebab')->where('DeskSebab','!=',null) as $row)
                <option>{{$row->DeskSebab}}</option>
                @endforeach
                </select>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3 text-right">
            <label for="table-filter-rekomend">Klasifikasi Rekomendasi : </label>
        </div>
        <div class="col-xs-2">
            <select id="table-filter-rekomend">
                <option value="">All</option>
                @foreach($result->unique('DeskRekomendasi')->where('DeskRekomendasi','!=',null) as $row)
                <option>{{$row->DeskRekomendasi}}</option>
                @endforeach
                </select>
        </div>
    </div>
    @endif
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
    <div class="row">
        <div class="col-xs-3 text-right">
            <label for="table-filter4">Status Kirim :</label>
        </div>
        <div class="col-xs-2">
            <select id="table-filter4">
                <option value="">All</option>
                @foreach($result->unique('StatKirim')->where('StatKirim','!=',null)->sortBy('StatKirim') as $row)
            <option value="{{$row->id_status_kirim}}">{{$row->StatKirim}}</option>
                @endforeach
                </select>
        </div>
    </div>

    </div>
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
          <th title="Tahun Pengawasan">Thn. Pgwsn</th>
          <th title="Unit">Unit</th>
          <th title="Tanggal Laporan">Tgl. Lap.</th>
          <th title="Nomor Laporan">No. Lap.</th>
          <th title="Nama Kegiatan Pengawasan">Nama Keg. Pgwsn</th>
          <th title="Jenis Pengawasan">Jenis Pgwsn</th>
          <th title="Judul Temuan">Temuan</th>
          <th title="Klasifikasi Temuan">Klasifikasi Temuan</th>
          <th title="Kondisi">Kondisi</th>
          <th title="Nilai Temuan">Nilai</th>
          <th title="Sebab">Sebab</th>
          <th title="Klasifikasi Sebab">Klasifikasi Sebab</th>
          <th title="Akibat">Akibat</th>
          <th title="Rekomendasi">Rekomendasi</th>
          <th title="Klasifikasi Rekomendasi">Klasifikasi Rekomendasi</th>
          <th title="Progres Rekomendasi">Progres Rekomendasi</th>
          <th title="Klasifikasi Tindak Lanjut">Status TL</th>
          <th style="width:50px">Aksi</th>
          <th>Inputer</th>
          <th>Status Kirim</th>
      </tr>
    </thead>

  </table>

@endsection
