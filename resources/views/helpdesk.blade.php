@extends('layout')
@section('content')
<div class="clear"></div>
<div class="container">
{{-- <div class="row"> --}}

    {{-- <div class="col-sm-7"><h5><img src="https://www.kemenkeu.go.id/media/6010/defaut1.jpg"/></h5><br/><h4>&nbsp;</h4></div>
    <div class="col-sm-5">

            <h5><span style="font-size: 1.25em;">TIM MANAJEMEN PENGAWASAN PNBP</span><br/>
            Inspektorat V<br/>Inspektorat Jenderal Kementerian Keuangan</h5>

        <div class="row">
            <div class="col-sm-2 text-right"><i class="fa fa-building"></i></div>
            <div class="col-sm-10">Gd. Djuanda 2 lt.9<br/>Jl. DR. Wahidin No.1 Jakarta Pusat</div>
        </div>
        <div class="row">
            <div class="col-sm-2 text-right"><i class="fa fa-phone"></i></div>
            <div class="col-sm-10">(021) 3454647</div>
        </div>
        <div class="row">
            <div class="col-sm-2 text-right"><i class="fa fa-fax"></i></div>
            <div class="col-sm-10">(021) 3454647</div>
        </div>
        <div class="row">
            <div class="col-sm-2 text-right"><i class="fa fa-envelope-open-text"></i></div>
            <div class="col-sm-10"><a class="text-primary" href="mailto:timwas.pnbp@kemenkeu.go.id">timwas.pnbp@kemenkeu.go.id</a></div>
        </div>
    </div> --}}
    {{-- <div class="col-sm-12"> --}}
        @if($privId == 2 || $privId == 5)
        <iframe id="biasa" src="{{env('LHC_MAIN_URL')}}" width="100%" height="500px" frameborder="0"></iframe>
        @else
        <iframe id="admin" src="{{env('LHC_LOGIN_URL')}}" width="100%" height="500px" frameborder="0"></iframe>
        @endif
    {{-- </div>
</div> --}}

</div>
@push('bottom')
<script>
    // Then call the code inside ready method like this
    $(document).ready(function () {
        // Get the iFrame jQuery Object
        var nameval = {!! json_encode($nama) !!};
            var emailval = {!! json_encode($email) !!};
        $("#biasa").contents().find("input[name='Username']").val(nameval);

        });
    });
    
    </script>
@endpush
@endsection
