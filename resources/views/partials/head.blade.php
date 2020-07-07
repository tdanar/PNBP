<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <meta charset="utf-8" />
        <title>{{ ($page_title)?Session::get('appname').': '.strip_tags($page_title):"Manajemen Pengawasan PNBP" }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--<link rel="stylesheet" type="text/css" href="/css/fanoe.css">-->
        <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    {{-- <link href="{{asset("vendor/crudbooster/assets/adminlte/font-awesome/css")}}/font-awesome.min.css" rel="stylesheet" type="text/css"/> --}}
    <!-- Ionicons -->
    <link href="{{asset("vendor/crudbooster/ionic/css/ionicons.min.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{ asset("vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("vendor/crudbooster/assets/adminlte/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="/css/basic.css" type="text/css">
        <link rel="stylesheet" href="/css/home.css" type="text/css">
        <link rel="stylesheet" href="/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="/css/responsive.css" type="text/css">
        <link rel="shortcut icon" href="/media/favicon.ico" type="image/x-icon" />
        <link href="https://vjs.zencdn.net/7.6.0/video-js.css" rel="stylesheet">

        <link href="/css/menu.css" rel="stylesheet" type="text/css">


        <link rel="stylesheet" href="/css/mega_menu.min.css" type="text/css"/>

        <link href="/css/mmenu_button.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="/css/jquery.mmenu.all.css" type="text/css"/>
        <link href="/css/font/fontawesome/css/all.css" rel="stylesheet">

        <style type="text/css">
            .dropdown-menu-action {
                left: -130%;
            }

            .btn-group-action .btn-action {
                cursor: default
            }

            #box-header-module {
                box-shadow: 10px 10px 10px #dddddd;
            }

            .sub-module-tab li {
                background: #F9F9F9;
                cursor: pointer;
            }

            .sub-module-tab li.active {
                background: #ffffff;
                box-shadow: 0px -5px 10px #cccccc
            }

            .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
                border: none;
            }

            .nav-tabs > li > a {
                border: none;
            }

            .breadcrumb {
                margin: 0 0 0 0;
                padding: 0 0 0 0;
            }

            header .top-header .right-top a.btn-flat.dropdown-toggle{
            color:rgb(0, 0, 0);
            font-weight:bold;
            }
            header .top-header .right-top a:hover.btn-flat.dropdown-toggle{
                color:#ffcb05;
            }

            ul.nav.navbar-nav li.dropdown.user.user-menu a.btn.btn-primary{
                color: #ffffff;
            }
            ul.nav.navbar-nav li.dropdown.user.user-menu a:hover.btn.btn-primary{
                color: #ffcb05;
                background-color: #ffffff;
            }

            ul.nav.navbar-nav li.dropdown.user.user-menu a:focus.btn.btn-primary{
                
                background-color: #3490dc;
            }

            .form-group > label:first-child {
                display: block
            }

            .holds-the-iframe {
                background:url(/vendor/crudbooster/assets/lightbox/dist/images/loading.gif) center center no-repeat;
                }


        </style>
</head>
