            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class='fa fa-clipboard-check'></i> Verifikasi Kelengkapan Data Laporan</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Hasil Verifikasi Laporan No. {{$data->no_lap}}
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Item</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kelengkapan Ikhtisar</td>
                                <td>
                                    @if ($data->tahun && $data->no_lap && $data->tanggal && $data->nama_giat_was && $data->thn_mulai && $data->thn_usai && $data->id_jenis_was)
                                    <span class="text-success">Semua data telah diisi.</span>
                                    @endif
                                    @if (!$data->tahun)
                                    <span class="text-danger">Tahun pengawasan belum diisi.</span><br/>
                                    @endif
                                    @if (!$data->no_lap)
                                    <span class="text-danger">Nomor laporan belum diisi.</span><br/>
                                    @endif
                                    @if (!$data->tanggal)
                                    <span class="text-danger">Tanggal laporan belum diisi.</span><br/>
                                    @endif
                                    @if (!$data->nama_giat_was)
                                    <span class="text-danger">Nama kegiatan pengawasan belum diisi.</span><br/>
                                    @endif
                                    @if (!$data->thn_mulai)
                                    <span class="text-danger">Tahun awal pengawasan belum diisi.</span><br/>
                                    @endif
                                    @if (!$data->thn_usai)
                                    <span class="text-danger">Tahun akhir pengawasan belum diisi.</span><br/>
                                    @endif
                                    @if (!$data->id_jenis_was)
                                    <span class="text-danger">Belum memilih jenis pengawasan.</span><br/>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>File PDF Laporan</td>
                                <td>
                                    @if (!$data->filename)
                                    <span class="text-danger">Belum ada file PDF. <a href="{{ CRUDBooster::mainpath("edit/$data->id") }}">Klik untuk mengunggah</a></span>
                                    @else
                                    <span class="text-success">Sudah ada file PDF. <a href="{{ asset($data->filename)}}" target="_blank">Klik untuk melihat</a></span>
                                    @endif
                                </td>
                            </tr>
                            @if ($data->id_jenis_was == 1)
                            <tr>
                                <td>Temuan</td>
                                <td>
                                    @if ($countTemuan == 0)
                                    <span class="text-danger">Wajib isi temuan bila jenis pengawasan audit.</span>
                                    @elseif ($countTemuan > 0 && $kod_temuan != 0)
                                    <span class="text-danger">Kodefikasi temuan harus diisi.</span>
                                    @elseif ($countTemuan > 0 && $kod_sebab != 0)
                                    <span class="text-danger">Kodefikasi sebab harus diisi.</span>
                                    @else
                                    <span class="text-success">Input Temuan sudah sesuai ketentuan.</span>
                                    @endif
                                </td>
                            </tr>
                            @elseif($data->id_jenis_was != 1 && $countTemuan > 0)
                            <tr>
                                <td>Temuan</td>
                                <td>
                                    @if ($kod_temuan != 0)
                                    <span class="text-danger">Kodefikasi temuan harus diisi.</span>
                                    @elseif ($kod_sebab != 0)
                                    <span class="text-danger">Kodefikasi sebab harus diisi.</span>
                                    @else
                                    <span class="text-success">Input Temuan sudah sesuai ketentuan.</span>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @if ($countTemuan > 0)
                            <tr>
                                <td>Rekomendasi</td>
                                <td>
                                    @if ($countRekomend <= 0)
                                    <span class="text-danger">Wajib isi rekomendasi bila ada temuan.</span>
                                    @elseif ($cekRek > 0)
                                    <span class="text-danger">Ada temuan yang belum memiliki rekomendasi.</span>
                                    @elseif ($cekRek == 0 && $kod_rekomend != 0)
                                    <span class="text-danger">Kodefikasi rekomendasi harus diisi.</span>
                                    @elseif ($cekRek == 0 && $kod_tl != 0)
                                    <span class="text-danger">Status tindak lanjut harus diisi.</span>
                                    @else
                                    <span class="text-success">Input Rekomendasi sudah sesuai ketentuan.</span>
                                    @endif
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary pull-right" onclick="klikKirim('{{CRUDBooster::adminPath($slug='kirim').'/'.$data->id}}')"
                @php
                    if(!$data->tahun || !$data->tanggal || !$data->nama_giat_was || !$data->thn_mulai || !$data->thn_usai || !$data->id_jenis_was || !$data->filename){
                        echo 'disabled="disabled"';
                    }elseif($data->id_jenis_was == 1 && $countTemuan == 0){
                        echo 'disabled="disabled"';
                    }elseif($countTemuan > 0 && $countRekomend <= 0){
                        echo 'disabled="disabled"';
                    }elseif($countTemuan > 0 && $kod_temuan != 0 && $kod_sebab != 0){
                        echo 'disabled="disabled"';
                    }elseif($countTemuan > 0 && $cekRek > 0){
                        echo 'disabled="disabled"';
                    }elseif($cekRek == 0 && $kod_rekomend != 0 && $kod_tl != 0){
                        echo 'disabled="disabled"';
                    }
                    else{
                        echo '';
                    }
                @endphp
                >Kirim</button>
            </div>




