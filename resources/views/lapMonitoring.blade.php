
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
                                url: '/api/getMonitorWas',
                                type: 'POST'
                            },
                    columns: [

                                        { 'data': null, 'render': function (data, type, full, meta) {
                                                return full.unit
                                            }
                                        },
                                        { 'data': null, 'render': function (data, type, full, meta) {
                                                return full.jenis_awas
                                            }
                                        },
                                        { 'data': 'nama_giat_was'},
                                        { 'data': 'jenis_awas'},
                                        { 'data': 'judul'},
                                        { 'data': 'nilai_uang'},
                                        { 'data': 'id','render': '',
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
                                    exportOptions: {
                                        columns: [1,2,3,5,6]
                                    }
                                }],
                    columnDefs: [{
                                targets: [0],
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
                                    $('#table-filter').on('change', function(e){
                                                table.column(0).search(this.value).draw();
                                                e.preventDefault();
                                                });
                                    $('#table-filter2').on('change', function(e){
                                                table.column(4).search(this.value).draw();
                                                e.preventDefault();
                                                });
                                    $('#table-filter3').on('change', function(e){
                                                table.column(8).search(this.value).draw();
                                                e.preventDefault();
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
                                    drawCallback(this.api());
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

    function drawCallback(api) {
        var rows = api.rows( {page:'current'} ).nodes(),
            settings = {
                    "COLUMN_THEME" : 0,
                    "COLUMN_SUBTHEME" : 1,
                    "COLUMN_SUBTHEME2" : 2,
                    "COLUMN_SUBTHEME3" : 3,
                    "COLUMN_SUBTHEME4" : 4,
                    "COLUMN_SUBTHEME5" : 5,
                    //"COLUMN_THEME2" : 7

            };

                $("#lapawas").find('td').show();
                mergeCells(rows, settings.COLUMN_THEME);
                mergeCells(rows, settings.COLUMN_SUBTHEME);
                mergeCells(rows, settings.COLUMN_SUBTHEME2);
                mergeCells(rows, settings.COLUMN_SUBTHEME3);
                mergeCells(rows, settings.COLUMN_SUBTHEME4);
                mergeCells(rows, settings.COLUMN_SUBTHEME5);
                //mergeCells(rows, settings.COLUMN_THEME2);

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
@if (session('status'))
    <div class="alert alert-info alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <strong>Sukses!</strong> {{ session('status') }}
      </div>
@endif
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
            <option>Dalam Proses</option>
            <option>Tuntas</option>
            </select>
    </div>
</div>
</div>
</div>
<table id="lapawas" border="1" class="display" style="width:100%">
  <thead>
      <tr>

        <th>Kementerian / Lembaga</th>
        <th>Jenis Pengawasan</th>
        <th>Jumlah Pengawasan</th>
        <th>Jumlah Temuan</th>
        <th>Jumlah Rekomendasi</th>
        <th>Status Tindak Lanjut</th>
        <th>Aksi</th>
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

<!-- ADD A PAGINATION -->
<p></p>

@endsection
