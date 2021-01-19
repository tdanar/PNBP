@extends('crudbooster::admin_template')
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title" style="color: white;">Pengaturan Tampilan</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8"><a href="/ma/settings/show?group=Pengaturan+Tampilan+Aplikasi&m=0" class="btn btn-primary btn-lg btn-block">Pengaturan Gambar Beranda</a></div>
            <div class="col-md-2">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8"><a href="/ma/slideshow" class="btn btn-primary btn-lg btn-block">Manajemen Slideshow</a></div>
            <div class="col-md-2">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8"><a href="/ma/pengumuman" class="btn btn-primary btn-lg btn-block">Manajemen Pengumuman Berjalan</a></div>
            <div class="col-md-2">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8"><a href="/ma/article" class="btn btn-primary btn-lg btn-block">Manajemen Artikel</a></div>
            <div class="col-md-2">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8"><a href="/ma/infografis" class="btn btn-primary btn-lg btn-block">Manajemen Infografis</a></div>
            <div class="col-md-2">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8"><a href="/ma/peraturan" class="btn btn-primary btn-lg btn-block">Manajemen Peraturan</a></div>
            <div class="col-md-2">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8"><a href="/ma/videoshow" class="btn btn-primary btn-lg btn-block">Manajemen Videoshow</a></div>
            <div class="col-md-2">&nbsp;</div>
        </div>
    </div>
</div>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title" style="color: white;">Pengaturan Grafik / Chart</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-8"><a href="/ma/settings/show?group=Pengaturan+Grafik+Beranda&m=0" class="btn btn-primary btn-lg btn-block">Pengaturan Parameter Grafik/Chart</a></div>
        <div class="col-md-2">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-8"><a href="/ma/diag_pnbp_jenis" class="btn btn-primary btn-lg btn-block">Grafik Tren PNBP Berdasarkan Jenis PNBP</a></div>
        <div class="col-md-2">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-8"><a href="/ma/diag_tren_pnbp" class="btn btn-primary btn-lg btn-block">Grafik Tren PNBP Dibanding Total PN</a></div>
        <div class="col-md-2">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-8"><a href="/ma/diag_rank_pnbp" class="btn btn-primary btn-lg btn-block">Grafik Realisasi PNBP Terbesar pada 10 K/L</a></div>
        <div class="col-md-2">&nbsp;</div>
    </div>
  </div>
</div>

@endsection