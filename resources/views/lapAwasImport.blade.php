@extends('crudbooster::admin_template')
@section('content')
<div class="container">
	<div class="alert alert-warning" role="alert">
        <b>Peringatan !</b>
        <br />Harap mengunggah file excel sesuai dengan format yang ditentukan dalam file di bawah ini:
        <br /><a href='#' class='alert-link'>Format Impor Excel</a>
    </div>
	<br />
	<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('/ma/importAwasExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="file" name="import_file" />
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
