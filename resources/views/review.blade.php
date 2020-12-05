<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
<div class='panel panel-default'>
    <div class='panel-heading'><strong><i class='fa fa-file'></i> Detail Laporan No. {{ $first->no_lap}}</strong></div>
    <div class='panel-body' style="padding:20px 0px 0px 0px">
            <div class='table-responsive'>
                <table id='table-detail' class='table table-striped'>
                        <tr>
                            <td class="pull-right"><strong>Tahun Pengawasan</strong></td>
                            <td>: {{$first->tahun}}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Periode Pengawasan</strong></td>
                            <td>: {{$first->thn_mulai}} - {{$first->thn_usai}}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Tanggal Laporan</strong></td>
                            <td>: {{ Carbon\Carbon::parse($first->tanggal)->formatLocalized('%d %B %Y') }}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Nama Kegiatan Pengawasan</strong></td>
                            <td>: {{$first->nama_giat_was}}</td>
                        </tr>

                        <tr>
                            <td class="pull-right"><strong>Status Kirim Laporan</strong></td>
                            <td>:
                                @if($first->id_status_kirim == 1 || $first->id_status_kirim == 4)
                                <strong class="text-danger">{{$first->StatKirim}}</strong>
                                @else
                                <strong class="text-success">{{$first->StatKirim}}</strong>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>PDF Laporan</strong></td>
                            <td>:
                                @if(!$first->filename)
                                <strong class="text-danger"><i>Belum unggah pdf</i></strong>
                                @else
                            <strong class="text-success"><a href="{{ asset($first->filename)}}">{{ $first->namafile }}</strong>
                                @endif
                            </td>
                        </tr>
                    @if($countTemuan > 0)
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10">

                                        <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#temuan" aria-controls="temuan" role="tab" data-toggle="tab">Temuan</a></li>
                                                <li role="presentation"><a href="#rekomendasi" aria-controls="rekomendasi" role="tab" data-toggle="tab">Rekomendasi</a></li>
                                            </ul>

                                        <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="temuan">
                                                        @foreach ($second as $index => $value)
                                                        <div class="row">
                                                            <div class="col-sm-12 text-justify"><strong class="text-primary">{{$index+1}}. {{$value->judul}}</strong></div>
                                                        </div>

                                                        <div class="row">
                                                                <div class="col-sm-4">
                                                                    &ensp;&ensp;&ensp;<strong>Lokasi</strong>
                                                                </div>
                                                                <div class="col-sm-8 text-justify">{{$value->lokasi}}
                                                                </div>
                                                            </div>
                                                        <div class="row">
                                                                <div class="col-sm-4">
                                                                    &ensp;&ensp;&ensp;<strong>Kondisi</strong>
                                                                </div>
                                                                <div class="col-sm-8 text-justify">{{$value->kondisi}}
                                                                </div>
                                                            </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                &ensp;&ensp;&ensp;<strong>Nilai</strong>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                {{$value->KodeMatauang.' '.number_format($value->nilai_uang,0,",",".")}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                &ensp;&ensp;&ensp;<strong>Sebab</strong>
                                                            </div>
                                                            <div class="col-sm-8 text-justify">{{$value->sebab}}
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                                <div class="col-sm-4">
                                                                    &ensp;&ensp;&ensp;<strong>Akibat</strong>
                                                                </div>
                                                                <div class="col-sm-8 text-justify">{{$value->akibat}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                </div>

                                                <div role="tabpanel" class="tab-pane" id="rekomendasi">
                                                        @if ($countRekomend > 0)
                                                        @foreach ($third as $index => $value)
                                                            <div class="row">
                                                                <div class="col-sm-12 text-justify"><strong class="text-primary">{{$index+1}}. {{$value->rekomendasi}}</strong></div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    &ensp;&ensp;&ensp;<strong>Tanggal Tindak Lanjut</strong>
                                                                </div>
                                                                <div class="col-sm-8 text-justify">{{ Carbon\Carbon::parse($value->tgl_tl)->formatLocalized('%d %B %Y') }}</div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    &ensp;&ensp;&ensp;<strong>Uraian Tindak Lanjut</strong>
                                                                </div>
                                                                    <div class="col-sm-8 text-justify">{{$value->tl}}</div>
                                                            </div>
                                                            <div class="row">
                                                                    <div class="col-sm-4">
                                                                        &ensp;&ensp;&ensp;<strong>Jenis Tindak Lanjut</strong>
                                                                    </div>
                                                                    <div class="col-sm-8 text-justify">{{$value->KodTL}}</div>
                                                            </div>
                                                        @endforeach
                                                        @endif
                                                </div>

                                            </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
    </div>
    <div class="panel-footer" style="background: #F5F5F5">
    <form method='post' id="form{{$first->id}}" enctype="multipart/form-data" action=''>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="lap_id" value="{{$first->id}}">
            <input type="hidden" name="user_id" value="{{CRUDBooster::myId()}}">
                <div class="row">
                    <label for="comment" class="text-bold">Komentar
                            </label>
                    <div style="width: 100%">
                        <textarea class="col-sm-12" name="comment" id="comment" rows="5"></textarea>
                    </div>
                </div>
            <div class="row">
                <label class="text-bold">Tolak/Terima ? <span class="text-danger">*</span>
                        </label>
                <div style="width: 100%">
                    <label class="radio-inline">
                        <input type="radio" name="accept" id="tolak" value="0" required> Tolak
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="accept" id="terima" value="1" required> Terima
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <input type="button" class="btn btn-default btn-block" value="Batal" id="batal" data-dismiss="modal"/>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div id="divKirim0" class="btnSubmit" hidden>
                        <input type="button" class="btn btn-primary btn-block" value="Kirim" id="kirim0" onclick="klikTolak({{$first->id}})"/>
                    </div>
                    <div id="divKirim1" class="btnSubmit" hidden>
                        <input type="button" class="btn btn-primary btn-block" value="Kirim" id="kirim1" onclick="klikSetuju({{$first->id}})"/>
                    </div>
                </div>

            </div>
        </form>

    </div>
  </div>
</div>

<div class="modal-footer">
</div>
<script>
    $(document).ready(function(){
        $("input[name$='accept']").click(function() {
        var test = $(this).val();
        //console.log(test);
        $("div.btnSubmit").hide();
        $("#divKirim" + test).show();
    });
    });
</script>
