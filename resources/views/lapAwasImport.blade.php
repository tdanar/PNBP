@extends('crudbooster::admin_template')
@section('content')
<div class="container">

	<div class="panel panel-info">
        <div class="panel-heading"><b>Peringatan !</b>
        <br />Harap mengunggah file excel sesuai dengan format yang ditentukan dalam file di bawah ini:
        <br/> <a class="btn btn-info" href='/media/excel/Formatsheet-Import-perbaikan 18112019_final.xlsx' class='alert-link'>Format Impor Excel</a>
        </div>
    </div>
	<br />
	<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('/ma/importAwasExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
        <input type="file" name="import_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
        <div class="row">
            <div class="col-md-12"><b class="text-danger">Peringatan !</b></div></div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="text-danger text-justify">
                        <li>Pastikan nomor laporan yang akan di-<i>import</i> <b class="text-primary">belum di-<i>input</i></b> secara manual melalui sub menu <b class="text-primary">"Input Laporan Pengawasan PNBP"</b> untuk menghindari gagal <i>import</i> karena adanya nomor laporan ganda.</li>
                        <li>Pastikan kolom yang berisi <b class="text-primary">tanggal</b> telah menggunakan format <b class="text-primary"><i>Date</i></b></li>
                        <li>Pastikan format <b class="text-primary">pengisian kodefikasi</b> telah <b class="text-primary">sesuai contoh pengisian (nomor saja)</b></li>
                        <li>Pastikan <b class="text-primary">petunjuk pengisian</b> pada <i>file</i> Format Impor Excel (Baris ke-2, warna latar belakang abu-abu) <b class="text-primary">tidak dihapus atau diganti</b></li>
                    </ul>
                </div>
            </div>


                                    @if(g('return_url'))
                                        <a href='{{g("return_url")}}' class='btn btn-default'><i
                                                    class='fa fa-chevron-circle-left'></i> {{trans("crudbooster.button_back")}}</a>
                                    @else
                                        <a href='{{CRUDBooster::mainpath("?".http_build_query(@$_GET)) }}' class='btn btn-default'><i
                                                    class='fa fa-chevron-circle-left'></i> {{trans("crudbooster.button_back")}}</a>
                                    @endif
                                <button class="btn btn-success">Impor File</button>
	</form>
</div>
@endsection
