@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  @if(g('return_url'))
                <p><a title='Return' href='{{g("return_url")}}'><i class='fa fa-chevron-circle-left '></i>
                        &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>
            @else
                <p><a title='Main Module' href='{{CRUDBooster::mainpath()}}'><i class='fa fa-chevron-circle-left '></i>
                        &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>
            @endif
  <div class='panel panel-default'>
  <div class='panel-heading'><strong><i class='fa fa-file'></i> Detail Laporan No. {{$first->no_lap}}</strong></div>
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
                            <td class="pull-right"><strong>Jenis Pengawasan</strong></td>
                            <td>: {{$first->jenis_awas}}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Status Kirim Laporan</strong></td>
                            <td>:
                                @if($first->id_status_kirim == 1)
                                <strong class="text-danger">{{$first->StatKirim}}</strong>
                                @else
                                <strong class="text-success">{{$first->StatKirim}}</strong>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                              <li role="presentation" class="active"><a href="#temuan" aria-controls="temuan" role="tab" data-toggle="tab">Temuan</a></li>
                                              <li role="presentation"><a href="#rekomendasi" aria-controls="profile" role="tab" data-toggle="tab">Rekomendasi</a></li>

                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane fade in active" id="temuan">
                                                        @foreach ($second as $index => $value)
                                                        <div class="row">
                                                            <div class="col-sm-12 text-justify"><strong class="text-primary">{{$index+1}}. {{$value->judul}}</strong></div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col-sm-4">
                                                                    &ensp;&ensp;&ensp;<strong>Klasifikasi Temuan</strong>
                                                                </div>
                                                                <div class="col-sm-8 text-justify">{{$value->DeskTemuan}}
                                                                </div>
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
                                                                    &ensp;&ensp;&ensp;<strong>Klasifikasi Sebab</strong>
                                                                </div>
                                                                <div class="col-sm-8 text-justify">{{$value->DeskSebab}}
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
                                                    <div role="tabpanel" class="tab-pane fade" id="rekomendasi">
                                                        @foreach ($third as $index => $value)
                                                        <div class="row">
                                                            <div class="col-sm-12 text-justify"><strong class="text-primary">{{$index+1}}. {{$value->rekomendasi}}</strong></div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col-sm-4">
                                                                    &ensp;&ensp;&ensp;<strong>Klasifikasi Rekomendasi</strong>
                                                                </div>
                                                                <div class="col-sm-8 text-justify">{{$value->DeskRekomendasi}}
                                                                </div>
                                                            </div>
                                                        <div class="row">
                                                                <div class="col-sm-4">
                                                                    &ensp;&ensp;&ensp;<strong>Tanggal Tindak Lanjut</strong>
                                                                </div>
                                                                <div class="col-sm-8 text-justify">{{ Carbon\Carbon::parse($value->tgl_tl)->formatLocalized('%d %B %Y') }}
                                                                </div>
                                                            </div>
                                                        <div class="row">
                                                                <div class="col-sm-4">
                                                                    &ensp;&ensp;&ensp;<strong>Uraian Tindak Lanjut</strong>
                                                                </div>
                                                                <div class="col-sm-8 text-justify">{{$value->tl}}
                                                                </div>
                                                            </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                &ensp;&ensp;&ensp;<strong>Status Tindak Lanjut</strong>
                                                            </div>
                                                            <div class="col-sm-8 text-justify">{{$value->status_tl}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col-sm-4">
                                                                    &ensp;&ensp;&ensp;<strong>Jenis Tindak Lanjut</strong>
                                                                </div>
                                                                <div class="col-sm-8 text-justify">{{$value->KodTL}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                  </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                            </td>
                        </tr>
                    </table>


            </div>

    </div>
  </div>
@endsection
