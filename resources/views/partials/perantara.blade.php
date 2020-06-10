@extends('layout')
@section('content')
<div style="min-height:650px">
        <center><form action="https://ssdpnbp.kemenkeu.go.id/OjFh75f59JlQ56/cX78hT923U1" method="post" id="form-login" target="_blank">
{{-- <center><form action="https://ssdpnbp.kemenkeu.go.id/OjFh75f59JlQ56/V6g8T4Z3L5" method="post" id="form-login"> --}}

    Klik untuk melanjutkan<br/>
    <?php if( $_SERVER['REQUEST_METHOD']=='POST' ){
        session_start();
        // ...
    } ?>
<input type="hidden" name="A67Vx32" value='<?php echo base64_encode(base64_encode(base64_encode($row->u_base)));?>' autocomplete="off"/>
<input type="hidden" name="A67Vx45" value='<?php echo md5($row->p_base);?>' autocomplete="off"/>
 <button type="submit" class="btn primary">Lanjut</button>
</form></center>
</div>
@endsection
