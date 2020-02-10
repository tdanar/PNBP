<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{trans("crudbooster.page_title_login")}} : Portal PNBP</title>
    <meta name='generator' content='CRUDBooster'/>
    <meta name='robots' content='noindex,nofollow'/>
    <link rel="shortcut icon"
          href="{{ CRUDBooster::getSetting('favicon')?asset(CRUDBooster::getSetting('favicon')):asset('media/favicon.ico') }}">

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{asset('vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{asset('vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css"/>
    


    <!-- support rtl-->
    @if (in_array(App::getLocale(), ['ar', 'fa']))
        <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
        <link href="{{ asset("vendor/crudbooster/assets/rtl.css")}}" rel="stylesheet" type="text/css"/>
@endif

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link rel='stylesheet' href='{{asset("vendor/crudbooster/assets/css/main.css")}}'/>
    <style type="text/css">
        .login-page, .register-page {
            background: {{ CRUDBooster::getSetting("login_background_color")?:'#dddddd'}} url('{{ CRUDBooster::getSetting("login_background_image")?asset(CRUDBooster::getSetting("login_background_image")):asset('vendor/crudbooster/assets/bg_blur3.jpg') }}');
            color: {{ CRUDBooster::getSetting("login_font_color")?:'#ffffff' }}  !important;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .login-box, .register-box {
            margin: 2% auto;
        }

        .login-box-body {
            box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.8);
            background: rgba(255, 255, 255, 0.9);
            color: {{ CRUDBooster::getSetting("login_font_color")?:'#666666' }}  !important;
        }

        html, body {
            overflow: hidden;
        }
    </style>
    <script>
            function refreshCaptcha(){
                $.ajax({
                url: "/refereshcapcha",
                type: 'GET',
                  dataType: 'html',
                  success: function(json) {
                    $('.refereshrecapcha').html(json);
                  },
                  error: function(data) {
                    alert('Coba Lagi.');
                  }
                });
                }
        </script>
</head>

<body class="login-page">

                            <div class="login-box">

                                    <div class="login-logo">
                                        <a href="{{url('/')}}">
                                            <img title='{!!(Session::get('appname') == 'CRUDBooster')?"<b>CRUD</b>Booster":CRUDBooster::getSetting('appname')!!}'
                                                src='{{ CRUDBooster::getSetting("logo")?asset(CRUDBooster::getSetting('logo')):asset('vendor/crudbooster/assets/logo_crudbooster.png') }}'
                                                style='max-width: 100%;max-height:170px'/>
                                        </a>
                                    </div><!-- /.login-logo -->


                                    <div class="login-box-body">

                                        @if ( Session::get('message') != '' )
                                            <div class='alert alert-warning'>
                                                {{ Session::get('message') }}
                                            </div>
                                        @endif

                                        <p class='login-box-msg'>{{trans("crudbooster.login_message")}}</p>
                                        <form autocomplete='off' action="{{ route('postLogin') }}" method="post" target="_top">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                            <div class="form-group has-feedback">
                                                <input autocomplete='off' type="text" class="form-control" name='username' required placeholder="Username"/>
                                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <input autocomplete='off' type="password" class="form-control" name='password' required placeholder="Password"/>
                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                            </div>
                                            <center>
                                            <div class="form-inline">
                                                <div class="form-group refereshrecapcha">
                                                    {!! captcha_img('flat') !!}
                                                </div>
                                                <div class="form-group"><a href="javascript:void(0)" class="btn btn-default" onclick="refreshCaptcha()"><i class="fa fa-refresh"></i></a></div>
                                            </div>


                                            <p><input autocomplete='off' class="form-control" type="text" name="captcha"></p>
                                            </center>
                                            <div style="margin-bottom:10px" class='row'>
                                                <div class='col-xs-12'>
                                                    <button type="submit" id="btn-login" class="btn btn-primary btn-block btn-flat"><i class='fa fa-lock'></i> {{trans("crudbooster.button_sign_in")}}</button>
                                                </div>
                                            </div>

                                            <div class='row'>
                                                <div class='col-xs-6' align="left"><p style="padding:10px 0px 10px 0px"> <a href='/' target='_top'>Kembali ke Halaman Utama</a></p></div>
                                                <div class='col-xs-6' align="right"><p style="padding:10px 0px 10px 0px"><a href='#' data-toggle="popover" title="<i class='fa fa-exclamation-triangle'></i>" data-content="Perubahan password hanya dapat dilakukan dengan menghubungi Admin Portal Pengawasan PNBP melalui email:<br/><a href='mailto:timwas.pnbp@kemenkeu.go.id'>timwas.pnbp@kemenkeu.go.id</a>">{{trans("crudbooster.text_forgot_password")}}</a></p></div>
                                            </div>
                                        </form>


                                        <br/>
                                        <!--a href="#">I forgot my password</a-->

                                    </div><!-- /.login-box-body -->

                            </div><!-- /.login-box -->



<!-- jQuery 2.1.3 -->
<script src="{{asset('vendor/crudbooster/assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="{{asset('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(
        function () {
                $('[data-toggle="popover"]').popover({
                    placement: 'top',
                    viewport: { selector: 'body', padding: 0 },
                    html: 'true'
                });

            }

            )

</script>

{{-- <script src="https://www.google.com/recaptcha/api.js" type="text/javascript"></script> --}}
</body>
</html>