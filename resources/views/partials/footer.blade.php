<footer>
			<div class="top-footer">
				<div class="container">
					<div class="top-link-footer">
                        <font></font>
                        &nbsp;
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<div class="bottom-footer">
				<div class="container">
					<div class="bottom-footer-left">
						<span>
						    <img src="/media/9769/logo-kemenkeu-w250px-02.png" onerror="this.onerror=null; this.src='/media/9769/logo-kemenkeu-w250px-02.png'" style="margin-top:-15px;" class="imgdesklogo"> 						 <img src="/media/9770/logo-kemenkeu-w250px-01.png" onerror="this.onerror=null; this.src='media/9770/logo-kemenkeu-w250px-02.png'" style="margin-top:-15px;display:none;" class="imgmoblogo"> </span>
						<font><br><br><br>
							Hak Cipta Kementerian Keuangan Republik Indonesia<br>
							Inspektorat V, Inspektorat Jenderal Kementerian Keuangan<br />
                            Gedung Djuanda II Lt. 9<br />
							Jl. Dr.Wahidin Raya No 1 Jakarta 10710<br />
							Telp: (021) 3454647 Fax: (021) 3454647<br />
							<div><h3 style="text-align:center;">
							    <div style="text-align:center;">
    </div></h3></div>
						</font>
					</div>
					<div class="social">
						<div class="hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1b">
							<a href="http://www.span.depkeu.go.id" target="_blank"><img src="/images/icon/span.png"/></a>
							<a href="https://simponi.kemenkeu.go.id" target="_blank"><img src="/images/icon/simfoni.png"/></a>
							<a href="http://elms.aaipi.or.id/aaipi/" target="_blank"><img src="/images/icon/aaipi.png"/></a>
						</div>
					</div>
					<div class="clear"></div>
				</div>
            </div>

			<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44275341-1', 'kemenkeu.go.id');
  ga('send', 'pageview');

</script>

    <!-- Start javascript Home -->
    <script type="text/javascript" src="https://unpkg.com/popper.js@latest/dist/umd/popper.js"></script>
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
        <script type="text/javascript" src="/scripts/jquery.min.js"></script>
        <script type="text/javascript" src="/scripts/bootstrap.min.js"></script>
    <script src="/vendor/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
		<script src="/vendor/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script type="text/javascript" src="/scripts/mega_menu.min.js"></script>
        <script type="text/javascript" src="/scripts/jquery.mmenu.all.js"></script>
		<script src="/scripts/home.js"></script>
		<script src="/vendor/owlcarousel/owl.carousel.js"></script>
		<script src="/scripts/scripts.js"></script>

        <!-- End javascript Home -->
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- AdminLTE App -->
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/dist/js/app.js') }}" type="text/javascript"></script>
<!--BOOTSTRAP DATEPICKER-->
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<link rel="stylesheet" href="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/datepicker/datepicker3.css') }}">

<!--BOOTSTRAP DATERANGEPICKER-->
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<link rel="stylesheet" href="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/daterangepicker/daterangepicker-bs3.css') }}">

<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/timepicker/bootstrap-timepicker.min.css') }}">
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<link rel='stylesheet' href='{{ asset("vendor/crudbooster/assets/lightbox/dist/css/lightbox.min.css") }}'/>
<script src="{{ asset('vendor/crudbooster/assets/lightbox/dist/js/lightbox.min.js') }}"></script>

<!--SWEET ALERT-->
<script src="{{asset('vendor/crudbooster/assets/sweetalert/dist/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('vendor/crudbooster/assets/sweetalert/dist/sweetalert.css')}}">

<!--MONEY FORMAT-->
<script src="{{asset('vendor/crudbooster/jquery.price_format.2.0.min.js')}}"></script>

<!--DATATABLE-->
<link rel="stylesheet" href="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/datatables/dataTables.bootstrap.css')}}">
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script>
    var ASSET_URL = "{{asset('/')}}";
    var APP_NAME = "{{Session::get('appname')}}";
    var ADMIN_PATH = '{{url(config("crudbooster.ADMIN_PATH")) }}';
    var NOTIFICATION_JSON = "{{route('NotificationsControllerGetLatestJson')}}";
    var NOTIFICATION_INDEX = "{{route('NotificationsControllerGetIndex')}}";

    var NOTIFICATION_YOU_HAVE = "{{trans('crudbooster.notification_you_have')}}";
    var NOTIFICATION_NOTIFICATIONS = "{{trans('crudbooster.notification_notification')}}";
    var NOTIFICATION_NEW = "{{trans('crudbooster.notification_new')}}";

    $(function () {
        $('.datatables-simple').DataTable();
    })
</script>
<script type="text/javascript" src="{{asset('vendor/crudbooster/assets/js/main.js').'?r='.time()}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#my-menu").mmenu({
            // options
            offCanvas: {
            position: "right"
            }
        }, {
            // configuration
            offCanvas: {
                pageSelector: "#my-wrapper"

            }
        });

        var API = $("#my-menu").data( "mmenu" );
        $('#ikeh').click(function() {
            API.open();
        });

    });
</script>
<script>
        $(document).ready(function () {
                    $('[data-toggle="popover-login"]').popover({
                        placement: 'bottom',
                        viewport: { selector: 'body', padding: 0 },
                        html: 'true'
                    })
                })
    </script>
@stack('bottom')
</footer>

