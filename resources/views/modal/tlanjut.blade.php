


<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title"><i class='fa fa-clipboard-check'></i> Monitoring Tindak Lanjut</h4>
</div>
<div class="modal-body">
    <div class="panel panel-info">
        <div class="panel-heading">
            Tindak Lanjut : {{$data[0]->unit}}
        </div>
        <div class="table-responsive">
            <div class="row">
                <div class="col-sm-12"></div>
            </div>
        <table class="table table-hover" id="tbl_tl{{$data[0]->id_unit.$data[0]->id_jenis_was}}" style="width:100%">
            <thead>
                <tr>
                    <td>No. Laporan</td>
                    <td>Kegiatan Pengawasan</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                <tr>
                <td>{{$row->no_lap}}</td>
                <td>{{$row->nama_giat_was}}</td>
                <td>
                   
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
<div class="modal-footer">

</div>
<script>
    $(document).ready(function() {
        
        $('#tbl_tl{!! json_encode($data[0]->id_unit)!!}{!! json_encode($data[0]->id_jenis_was)!!}').DataTable({
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
        processing: true,
        searching: true,
        paging: true,
        responsive: true,
        dom: '<"row"<"col-sm-6"l><"col-sm-6"<"pull-right"f>>><"table"rt><"modal-footer"pi>',
        columnDefs: [{
                    targets: [2],
                    searchable: false,
                    orderable: false,
                    } ]
                })
    });
</script>