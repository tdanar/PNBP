            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class='fa fa-clipboard-check'></i> Download File PDF</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        File pdf tersedia dari : {{$data[0]->unit}}
                    </div>
                    <table class="table">
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
                                @if($row->filename && in_array(CRUDBooster::myPrivilegeId(),array(1,3,4)))
                                <a class="btn btn-primary" href="{{ asset($row->filename)}}" target="_blank">Unduh</a>
                                @elseif($row->filename && in_array(CRUDBooster::myPrivilegeId(),array(2,5)))
                                <a class="btn btn-default" href="#" disabled>Unduh</a>
                                @else
                                <span class="text-danger">File PDF rusak / belum diunggah</span>
                                @endif
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">

            </div>




