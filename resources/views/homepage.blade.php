@extends('layout')
@section('content')
<div class="clear"></div>
    	<div id="my-content">
			<div class="slider">
					<div class="fadeOut owl-carousel owl-theme">


						<div class="item">

							<img src='/images/beranda_1.jpeg' />
							<div class="search" style="bottom:25%">
							<div class="text-search">
						</div>
						</div>
						</div>
						<div class="item">

							<img src='/images/beranda_2.jpeg' />
							<div class="search" style="bottom:25%">
							<div class="text-search">
						</div>
						</div>
						</div>
						<div class="item">

							<img src='/images/beranda_3.jpeg' />
							<div class="search" style="bottom:25%">
							<div class="text-search">

						</div>
						</div>
                        </div>

					</div>
					<div class="bg_slider"></div>
			</div>

		<div class="clear"></div>
        <div class="bgs122">


					<div class="bgs122-title"></div>
					<span></span>

				<div class="bgs122-data">

					<marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                    @foreach ($pengumuman as $index => $item)
                    @if($index == 0)
                    <a href="{{$item->link}}" target="_blank">{{$item->pengumuman}}</a>
                    @else
                    <span>---&nbsp;</span><a href="{{$item->link}}" target="_blank">{{$item->pengumuman}}</a>
                    @endif
                    @endforeach
                   </marquee>

				</div>

		</div>
		<div class="container">
		</div>

		<section id="content">
			<div class="news-data owl-carousel owl-theme">
                @foreach ($artikel as $item)
                    <div class="item">
                    <div class="news" style="background:url('{{$item->cover}}')center center no-repeat;background-size:100%;">
                                                <div class="mask">
                                                <a href="/artikel/{{$item->id}}">{{$item->judul}}</a>

                                                <p>{{$item->sub_judul}}</p>
                                                    <a href="/artikel/{{$item->id}}" class="btn-merah-news">Selengkapnya</a>
                                                </div>
                                            </div>
                    </div>
                @endforeach
			</div>
		<div class="container" style="background:white;">
				<div class="data-apbn">
								<h1 class="heading">DATA PNBP</h1>
                                    <div id="thumb_graph">
                                        <div class="graph_thumb owl-carousel owl-theme">

                                            <div class="item active th_1">
                                                <a onclick="javascript:load_graph('1','1');" href="javascript:void(0);">
                                                    <img src="/media/5793/36cbd014-2a4b-46eb-ae2c-13ccefc0b651.jpg" style="margin-left:auto;margin-right:auto;max-width:95%;max-height:95%">
                                                </a>
                                            </div>
                                            <div class="item active th_2">
                                                <a onclick="javascript:load_graph('2','2');" href="javascript:void(0);">
                                                    <img src="/media/5794/8b1fb82d-606d-41d0-ac4e-3dfd46a44add.jpg" style="margin-left:auto;margin-right:auto;max-width:95%;max-height:95%">
                                                </a>
                                            </div>

                                            <div class="item active th_3">
                                                <a onclick="javascript:load_graph('3','3');" href="javascript:void(0);">
                                                    <img src="/media/5795/60b64532-dee9-424c-a391-1c864417c244.jpg" style="margin-left:auto;margin-right:auto;max-width:95%;max-height:95%">
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                    <h2 class="heading gra active" id="graphshead1">Tren Realisasi PNBP per Jenis PNBP <p style="font-size:80%">Tahun 2014 s.d. 2018</p><p>Sumber: LKPP Audited </p></h2>
                                    <h2 class="heading gra" id="graphshead2">Tren Perbandingan Realisasi PNBP dengan Penerimaan Negara <p style="font-size:80%">Tahun 2014 s.d. 2018</p><p>Sumber: LKPP Audited </p></h2>
                                    <h2 class="heading gra" id="graphshead3">Realisasi PNBP Terbesar pada 10 Kementerian / Lembaga<p style="font-size:80%">Tahun 2018</p><p>Sumber: Aplikasi SIMPONI </p> </h2>
                                    <h2 class="heading gra" id="graphshead4"> </h2>
                                    <h2 class="heading gra" id="graphshead5"> </h2>
                                    <h2 class="heading gra" id="graphshead6"> </h2>

                                    <div class="gr">
                                            <div id="graphs1" class="gr active"></div>
                                            <div id="graphs2" class="gr"></div>
                                            <div id="graphs3" class="gr"></div>
                                            <div id="graphs4" class="gr"></div>
                                            <div id="graphs5" class="gr"></div>
                                            <div id="graphs6" class="gr"></div>
                                        </div>
								<script src="/vendor/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
                                <script src="/vendor/amcharts/amcharts/serial.js" type="text/javascript"></script>

								<script type="text/javascript">
								var chart;
						        var chartData = JSON.parse("{{$pnbp_jenis}}".replace(/&quot;/g,'"'));
                                       // console.log(chartData);
							AmCharts.ready(function () {
							chart = new AmCharts.AmSerialChart();
							chart.dataProvider = chartData;
							chart.categoryField = "Tahun";
							chart.color = "#222222";
							chart.fontSize = 14;
							//chart.startDuration = 1;
							chart.plotAreaFillAlphas = 0.2;
							chart.angle = 30;

                                chart.depth3D = 0;
                                chart.decimalSeparator = ",";
					            chart.thousandsSeparator = ".";



							var categoryAxis = chart.categoryAxis;
							categoryAxis.gridAlpha = 0.2;
							categoryAxis.gridPosition = "start";
							categoryAxis.gridColor = "#555555";
							categoryAxis.axisColor = "#222222";
							categoryAxis.axisAlpha = 0.5;
							categoryAxis.dashLength = 5;

							var valueAxis = new AmCharts.ValueAxis();
							valueAxis.stackType = "regular";
							valueAxis.gridAlpha = 0.2;
							valueAxis.gridColor = "#222222";
							valueAxis.axisColor = "#000000";
							valueAxis.axisAlpha = 0.5;
							valueAxis.dashLength = 5;
							valueAxis.title = "Jumlah (triliun Rupiah)";
							valueAxis.titleColor = "#222222";
							valueAxis.unit = "";
                            chart.addValueAxis(valueAxis);

                            var graph1 = new AmCharts.AmGraph();
							graph1.title = "Penerimaan SDA";
							graph1.valueField = "Penerimaan SDA";
							graph1.type = "column";
							graph1.lineAlpha = 0;
							graph1.lineColor = "#FFC300";
							graph1.fillAlphas = 1;
                            graph1.balloonText = "Penerimaan SDA [[category]] : [[value]]";

                            chart.addGraph(graph1);

                            var graph3 = new AmCharts.AmGraph();
							graph3.title = "Pendapatan dari Kekayaan Negara Dipisahkan";
							graph3.valueField = "Pendapatan dari Kekayaan Negara Dipisahkan";
							graph3.type = "column";
							graph3.lineAlpha = 0;
							graph3.lineColor = "#266E01";
							graph3.fillAlphas = 1;
							graph3.balloonText = "Pendapatan dari Kekayaan Negara Dipisahkan [[category]] : [[value]]";
                            chart.addGraph(graph3);

                            var graph2 = new AmCharts.AmGraph();
							graph2.title = "Belanja Pemerintah atas Laba BUMN";
							graph2.valueField = "Belanja Pemerintah atas Laba BUMN";
							graph2.type = "column";
							graph2.lineAlpha = 0;
							graph2.lineColor = "#BCBCBC";
							graph2.fillAlphas = 1;
							graph2.balloonText = "Belanja Pemerintah atas Laba BUMN [[category]] : [[value]]";
                            chart.addGraph(graph2);

                            var graph4 = new AmCharts.AmGraph();
							graph4.title = "PNBP Lainnya";
							graph4.valueField = "PNBP Lainnya";
							graph4.type = "column";
							graph4.lineAlpha = 0;
							graph4.lineColor = "#5143FF";
							graph4.fillAlphas = 1;
							graph4.balloonText = "PNBP Lainnya [[category]] : [[value]]";
                            chart.addGraph(graph4);

                            var graph5 = new AmCharts.AmGraph();
							graph5.title = "Pendapatan BLU";
							graph5.valueField = "Pendapatan BLU";
							graph5.type = "column";
							graph5.lineAlpha = 0;
							graph5.lineColor = "#FF5733";
							graph5.fillAlphas = 1;
							graph5.balloonText = "Pendapatan BLU [[category]] : [[value]]";
                            chart.addGraph(graph5);

                            var graph0 = new AmCharts.AmGraph();
                            graph0.type = "line";
                            graph0.title = "Total Keseluruhan";
							graph0.balloonText = "Total Keseluruhan [[category]] : [[value]]";
							graph0.lineColor = "#C70039";
							graph0.valueField = "Total";
							graph0.lineThickness = 5;
							graph0.bullet = "round";
                            graph0.bulletBorderThickness = 3;
                            graph0.bulletBorderColor = "#fcd202";
                            graph0.bulletBorderAlpha = 1;
                            graph0.bulletColor = "#ffffff";
                            //graph0.dashLengthField = "dashLengthLine";
                            chart.addGraph(graph0);

                            var legend = new AmCharts.AmLegend();
							legend.useGraphSettings = true;
							chart.addLegend(legend);
							chart.write("graphs1");
						});
						var chartData2 = JSON.parse("{{$pnbp_tren}}".replace(/&quot;/g,'"'));
						AmCharts.ready(function () {
							chart = new AmCharts.AmSerialChart();

							chart.dataProvider = chartData2;
							chart.categoryField = "tahun";
							chart.startDuration = 1;

							//chart.handDrawn = true;
							//chart.handDrawnScatter = 3;
							chart.angle = 25;

								chart.depth3D = 0;
                                chart.decimalSeparator = ",";
                                chart.thousandsSeparator = ".";
                                chart.percentPrecision = 2;



							var categoryAxis = chart.categoryAxis;
							categoryAxis.gridPosition = "start";





							var graph1 = new AmCharts.AmGraph();
							graph1.type = "line";
							graph1.title = "Realisasi PNBP";
							graph1.lineColor = "#FF0017";
							graph1.valueField = "realisasi_pnbp";
							graph1.lineThickness = 10;
                            graph1.labelText = "[[persentase]]%";
                            graph1.fontSize = 30

							graph1.customBullet = "/images/point_hijau.png";
                            graph1.bulletSize = 50;
							graph1.dashLengthField = "dashLengthLine";


							var graph2 = new AmCharts.AmGraph();
							graph2.type = "line";
							graph2.title = "Realisasi Penerimaan Negara";
							graph2.lineColor = "#194C85";
							graph2.valueField = "realisasi_pn";
							graph2.lineThickness = 10;

                            graph2.customBullet = "/images/point_merah.png";
                            graph2.bulletSize = 50;
							graph2.dashLengthField = "dashLengthLine";

							var valueAxis = new AmCharts.ValueAxis();
							valueAxis.stackType = "regular";
							valueAxis.gridAlpha = 0.2;
							valueAxis.gridColor = "#222222";
							valueAxis.axisColor = "#000000";
							valueAxis.axisAlpha = 0.5;
							valueAxis.dashLength = 5;
							valueAxis.title = "Jumlah (triliun Rupiah)";
							valueAxis.titleColor = "#222222";
							valueAxis.unit = "";
							chart.addValueAxis(valueAxis);

                            graph1.balloonText = "<span style='font-size:13px;'>[[title]] [[category]]:<b>[[value]]</b> [[additional]]</span>";
							graph2.balloonText = "<span style='font-size:13px;'>[[title]] [[category]]:<b>[[value]]</b> [[additional]]</span>";
                            chart.addGraph(graph1);
							chart.addGraph(graph2);


							var legend = new AmCharts.AmLegend();
							legend.useGraphSettings = true;
							chart.addLegend(legend);

							chart.write("graphs2");
						});
								</script>

                        <!-- amCharts javascript code -->
                        <script type="text/javascript">
                            AmCharts.makeChart("graphs3",
                                {
                                    "type": "serial",
                                    "categoryField": "category",
                                    "columnSpacing3D": 5,
                                    "angle": 30,
                                    "depth3D": 30,
                                    "colors": [
                                        "#e3ed1c","#1ced5b"
                                    ],
                                    "startDuration": 1,
                                    "startEffect": "bounce",
                                    "decimalSeparator": ",",
                                    "fontFamily": "Calibri",
                                    "fontSize": 12,
                                    "handDrawScatter": 4,
                                    "handDrawThickness": 4,
                                    "categoryAxis": {
                                        "autoRotateAngle": 25.2,
                                        "autoRotateCount": 1,
                                        "gridPosition": "start"
                                    },
                                    "trendLines": [],
                                    "graphs": [
                                        {
                                            "balloonText": "[[title]] [[category]] : Rp. [[value]] Triliun ",
                                            "fillAlphas": 1,
                                            "id": "AmGraph-1",
                                            "title": "Target",
                                            "type": "column",
                                            "valueField": "target"
                                        },
                                        {
                                            "balloonText": "[[title]] [[category]] : Rp. [[value]] Triliun ",
                                            "bullet": "round",
                                            "bulletColor": "#FFFFFF",
                                            "bulletHitAreaSize": 0,
                                            "bulletOffset": 20,
                                            "bulletSize": 30,
                                            "customBullet": "",
                                            "customBulletField": "bullet",
                                            "fillAlphas": 1,
                                            "id": "AmGraph-2",
                                            "title": "Realisasi",
                                            "type": "column",
                                            "valueField": "realization"
                                        }
                                    ],
                                    "guides": [],
                                    "valueAxes": [
                                        {
                                            "id": "ValueAxis-1",
                                            "stackType": "3d",
                                            "title": "(dalam Triliun Rupiah)"
                                        }
                                    ],
                                    "allLabels": [],
                                    "balloon": {},
                                    "legend": {
                                        "enabled": true,
                                        "align": "right",
                                        "combineLegend": true,
                                        "position": "absolute",
                                        "top": 10,
                                        "useGraphSettings": true
                                    },
                                    "titles": [],
                                    "dataProvider": [
                                        {
                                            "category": "Kementerian ESDM",
                                            "target": "33.35",
                                            "realization": "65.22",
                                            "bullet": "https://www.esdm.go.id/assets/imagecache/bodyView/xprofil-arti-logo-cszkz2w.png.pagespeed.ic.pDXwEJXIcZ.png"
                                        },
                                        {
                                            "category": "Kementerian Kominfo",
                                            "target": "18.67",
                                            "realization": "21.39",
                                            "bullet": "https://ppidkemkominfo.files.wordpress.com/2011/03/logo-kominfo-copy.jpg"
                                        },
                                        {
                                            "category": "Kementerian Keuangan",
                                            "target": "14.43",
                                            "realization": "21.15",
                                            "bullet": "https://upload.wikimedia.org/wikipedia/commons/7/73/Logo_kementerian_keuangan_republik_indonesia.png"
                                        },
                                        {
                                            "category": "Kementerian Ristek & PT",
                                            "target": "9.73",
                                            "realization": "12.82",
                                            "bullet": "https://upload.wikimedia.org/wikipedia/commons/b/b7/Logo_of_the_Ministry_of_Research%2C_Technology%2C_and_Higher_Education_of_the_Republic_of_Indonesia.png"
                                        },
                                        {
                                            "category": "Kementerian Kesehatan",
                                            "target": "11.72",
                                            "realization": "12.04",
                                            "bullet": "https://e-renggar.kemkes.go.id/images/img/logodepan.png"
                                        },
                                        {
                                            "category": "Kepolisian",
                                            "target": "10.9",
                                            "realization": "11.51",
                                            "bullet": "https://upload.wikimedia.org/wikipedia/commons/6/6e/Lambang_Polri.png"
                                        },
                                        {
                                            "category": "Kementerian Perhubungan",
                                            "target": "9",
                                            "realization": "8.21",
                                            "bullet": "http://1.bp.blogspot.com/-5A2Yam-5lbI/UOp_hR3aTsI/AAAAAAAAKlc/iFu32z6AH8Q/s1600/LOGO+KEMENTERIAN+PERHUBUNGAN.png"
                                        },
                                        {
                                            "category": "Kementerian Pertahanan",
                                            "target": "3.99",
                                            "realization": "6.75",
                                            "bullet": "https://upload.wikimedia.org/wikipedia/commons/6/60/Logo_of_the_Ministry_of_Defence_of_the_Republic_of_Indonesia.svg"
                                        },
                                        {
                                            "category": "Kementerian LHK",
                                            "target": "4.41",
                                            "realization": "5.51",
                                            "bullet": "https://upload.wikimedia.org/wikipedia/commons/6/63/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png"
                                        },
                                        {
                                            "category": "Kementerian Hukum & HAM",
                                            "target": "3.25",
                                            "realization": "3.56",
                                            "bullet": "https://www.kemenkumham.go.id/images/jux_portfolio_pro/logo_fix.png"
                                        }
                                    ]
                                }
                            );
                        </script>


				</div>

			</div>
                        <div class="clear">&nbsp;</div>
						<div class="bgs123">
							<div class="container">

									<span class="bgs123-data">
                                        <div class="row">
                                            <div class="col-md-1">&nbsp;</div>
                                            <div class="col-md-8"><b><span class="pull-right">Hasil Pengawasan PNBP oleh APIP K/L TA : </span></b></div>
                                            <div class="col-md-1"> <select class="text-left" id="sel_tahun">
                                                <option value="">All</option>
                                                @foreach($tahunSelector->unique('tahun') as $row)
                                                <option>{{$row->tahun}}</option>
                                                @endforeach</select>
                                            </div>
                                            <div class="col-md-2">&nbsp;</div>
                                        </div>
                                    </span>
							</div>
                        </div>
                        <!-- amCharts javascript sources -->
                        <script src="/vendor/amcharts/amcharts/pie.js" type="text/javascript"></script>
                        <script src="/scripts/lodash.min.js" type="text/javascript"></script>
                        <!-- amCharts javascript code -->
                            <script type="text/javascript">
                                var data2= JSON.parse("{{$pnbp_tl}}".replace(/&quot;/g,'"'));
                                AmCharts.makeChart("piegraphs3",
                                    {
                                        "type": "pie",
                                        "adjustPrecision": true,
                                        "angle": 20,
                                        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[percents]]%</b></span>",
                                        "depth3D": 30,
                                        "labelRadius": -100,
                                        "labelText": "[[percents]]%<br>[[title]]",
                                        "colors": [
                                            "#88E0B0",
                                            "#FF5771",
                                            "#FFCF00",
                                            "#5FABBB"
                                        ],
                                        "marginBottom": 0,
					                    "marginTop": 0,
                                        "titleField": "Jenis Tindak Lanjut",
                                        "valueField": "Jumlah",
                                        "decimalSeparator": ",",
                                        "fontFamily": "Calibri",
                                        "fontSize": 12,
                                        "percentPrecision": 0,
                                        "thousandsSeparator": ".",
                                        "allLabels": [],
                                        "balloon": {},
                                        "legend": {
                                            "enabled": true,
                                            "align": "center",
                                            "labelText": "[[title]]:",
                                            "markerType": "circle",
                                            "maxColumns": 2,
                                            "valueAlign": "left",
                                            "valueText": "[[percents]]%"
                                        },
                                        "titles": [
                                            {
                                                "id": "judul",
                                                "size": 25,
                                                "text": "Status Tindak Lanjut Temuan Pengawasan"
                                            }
                                        ],
                                        "dataProvider": data2
                                    }
                                );
                            </script>

                        <!-- amCharts javascript code -->
                        <script type="text/javascript">
                            var data1 = JSON.parse("{{$pnbp_temuan}}".replace(/&quot;/g,'"'));
                            AmCharts.addInitHandler(function(chart) {
                                if (chart.legend === undefined || chart.legend.truncateLabels === undefined)
                                    return;

                                // init fields
                                var titleField = chart.titleField;
                                var legendTitleField = chart.titleField+"Legend";

                                // iterate through the data and create truncated label properties
                                for(var i = 0; i < chart.dataProvider.length; i++) {
                                    var label = chart.dataProvider[i][chart.titleField];
                                    if (label.length > chart.legend.truncateLabels)
                                    label = label.substr(0, chart.legend.truncateLabels-1)+'...'
                                    chart.dataProvider[i][legendTitleField] = label;
                                }

                                // replace chart.titleField to show our own truncated field
                                chart.titleField = legendTitleField;

                                // make the balloonText use full title instead
                                chart.balloonText = chart.balloonText.replace(/\[\[title\]\]/, "[["+titleField+"]]");

                                }, ["pie"]);
                            var chart = AmCharts.makeChart("piegraphs4",
                                {
                                    "type": "pie",
                                    "adjustPrecision": true,
                                    "angle": 20,
                                    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[percents]]%</b></span>",
                                    "depth3D": 30,
                                    "labelRadius": -100,
                                    "labelText": "[[percents]]%<br>[[title]]",
                                    "colors": [
                                        "#6ABBFC",
                                        "#FFE457",
                                        "#2DFF00",
                                        "#8D95F8"
                                        ],
                                    "marginBottom": 0,
					                "marginTop": 0,
                                    "titles": [
                                                                {
                                                                    "id": "judul",
                                                                    "size": 25,
                                                                    "text": "Berdasarkan Jenis Temuan"
                                                                }
                                                            ],
                                    "dataProvider": data1,
                                    "valueField": "Jumlah",
                                    "titleField": "Jenis Temuan",
                                        "decimalSeparator": ",",
                                        "fontFamily": "Calibri",
                                        "fontSize": 12,
                                        "percentPrecision": 0,
                                        "thousandsSeparator": ".",
                                        "allLabels": [],
                                        "balloon": {},
                                        "legend": {
                                            "enabled": true,
                                            "align": "center",
                                            "labelText": "[[title]]:",
                                            "markerType": "circle",
                                            "maxColumns": 2,
                                            "valueAlign": "left",
                                            "valueText": "[[percents]]%"
                                        }

                                }
                            );
                        </script>
                        <div class="cls-lintas" style="background:white;">

                                        <div id="piegraphs4" class="col-md-6"></div>
                                        <div id="piegraphs3" class="col-md-6"></div>

                        </div>
                        <div class="clear">&nbsp;</div>
						<div class="bgs123">
							<div class="container">

									<center class="bgs123-data"><b>Infografis PNBP</b></center>
							</div>
                        </div>
                        <div class="infografis owl-carousel owl-theme">
                            @foreach ($infografis as $igrafis)
                            <div class="item">
                            <div class="news" style="background:url('{{$igrafis->cover}}')center center no-repeat;background-size:100%;">
                                        <div class="mask">
                                            <a href="{{$igrafis->cover}}?download=1"></a>
                                            <a href="{{$igrafis->file}}?download=1" class="btn-merah-news" target="_blank">Unduh</a>
                                        </div>
                                    </div>
                            </div>
                            @endforeach
                        </div>

                <div class="cls-peraturan">
                        <div class="container">
                            <div class="text-center">
                                <h2 class="heading color-white">Peraturan PNBP</h2>
                                <style>
                                        .peraturantext {
                                            background:transparent !important;
                                            text-decoration:underline !important;
                                        }
                                        .peraturantext:hover {
                                            color:#fff !important;
                                        }


                                    </style>
                                <div class="own-peraturan owl-carousel owl-theme">





                                    <div class="item">
                                        <span><dd class="ico-1"></dd></span>
                                        <a href="\peraturan">Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="infografis owl-carousel owl-theme">
                            <div class="item">
                                <div class="newsv">
                                    <video id='my-video' class='video-js vjs-default-skin vjs-4-3 vjs-big-play-centered' controls preload='auto' responsive='true'
                                    width='480' height='480' poster='https://klcfiles.kemenkeu.go.id/2018/12/3-2.jpg' data-setup='{"fluid": true}'>
                                        <source src='https://klcfiles.kemenkeu.go.id/2018/12/PNBP.mp4' type='video/mp4'>
                                        <p class='vjs-no-js'>
                                        To view this video please enable JavaScript, and consider upgrading to a web browser that
                                        <a href='https://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>
                                        </p>
                                    </video>

                                    <script src='https://vjs.zencdn.net/7.6.0/video.js'></script>
                                </div>
                            </div>
                            <div class="item">
                                    <div class="newsv">
                                            <video id='my-video-1' class='video-js vjs-default-skin vjs-4-3 vjs-big-play-centered' controls preload='auto' responsive='true'
                                            width='480' height='480' poster='https://klcfiles.kemenkeu.go.id/2018/06/1-3.jpg' data-setup='{"fluid": true}'>
                                                <source src='https://klcfiles.kemenkeu.go.id/2018/06/KC-1-Pak-Zun.mp4' type='video/mp4'>
                                                <p class='vjs-no-js'>
                                                To view this video please enable JavaScript, and consider upgrading to a web browser that
                                                <a href='https://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>
                                                </p>
                                            </video>

                                            <script src='https://vjs.zencdn.net/7.6.0/video.js'></script>
                                        </div>
                            </div>
                            <div class="item">
                                    <div class="newsv">
                                            <video id='my-video-2' class='video-js vjs-default-skin vjs-4-3 vjs-big-play-centered' controls preload='auto' responsive='true'
                                            width='480' height='480' poster='https://klcfiles.kemenkeu.go.id/2018/05/1-2.jpg' data-setup='{"fluid": true}'>
                                                <source src='https://klcfiles.kemenkeu.go.id/2018/05/KC-1-Pak-Luhut-conv.mp4' type='video/mp4'>
                                                <p class='vjs-no-js'>
                                                To view this video please enable JavaScript, and consider upgrading to a web browser that
                                                <a href='https://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>
                                                </p>
                                            </video>

                                            <script src='https://vjs.zencdn.net/7.6.0/video.js'></script>
                                        </div>
                            </div>
                            <div class="item">
                                    <div class="newsv">
                                            <video id='my-video-3' class='video-js vjs-default-skin vjs-4-3 vjs-big-play-centered' controls preload='auto' responsive='true'
                                            width='480' height='480' poster='https://klcfiles.kemenkeu.go.id/2018/10/4-1.jpg' data-setup='{"fluid": true}'>
                                                <source src='https://klcfiles.kemenkeu.go.id/2018/10/4.-Noor-Cholis-Madjid-Tugas-dan-Wewenang-Menteri-Keuangan-dalam-Pengelolaan-PNBP.mp4' type='video/mp4'>
                                                <p class='vjs-no-js'>
                                                To view this video please enable JavaScript, and consider upgrading to a web browser that
                                                <a href='https://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>
                                                </p>
                                            </video>

                                            <script src='https://vjs.zencdn.net/7.6.0/video.js'></script>
                                        </div>
                            </div>
                            <div class="item">
                                    <div class="newsv">
                                            <video id='my-video-4' class='video-js vjs-default-skin vjs-4-3 vjs-big-play-centered' controls preload='auto' responsive='true'
                                            width='480' height='480' poster='https://klcfiles.kemenkeu.go.id/2018/10/3-3.jpg' data-setup='{"fluid": true}'>
                                                <source src='https://klcfiles.kemenkeu.go.id/2018/10/4.-Heryanto-Sijabat-MPN-G2.mp4' type='video/mp4'>
                                                <p class='vjs-no-js'>
                                                To view this video please enable JavaScript, and consider upgrading to a web browser that
                                                <a href='https://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>
                                                </p>
                                            </video>

                                            <script src='https://vjs.zencdn.net/7.6.0/video.js'></script>
                                    </div>
                            </div>
                        </div>
                    </section>
        </div id="my-footer">
    <div>
            <section class="hidden-desk	">
                    <div class="container">
                        <div class="menu-home-mobile">
                            <a href="/ma/lap_awas"><div class="ico_1"><span>E-Reporting</span></div></a>
                            <a href="/infopnbp"><div class="ico_2"><span>Info PNBP</span></div></a>
                            <a href="/helpdesk"><div class="ico_3"><span>Hubungi Kami</span></div></a>
                            <a href="/faq"><div class="ico_4"><span>Panduan</span></div></a>
                            <div class="clear"></div>
                        </div>
                    </div>
                </section>

@endsection
