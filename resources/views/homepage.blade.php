@extends('layout')
@section('content')
<div class="clear"></div>
    	<div id="my-content">
			<div class="slider">
					<div class="bg_search"></div>
					<div class="search">
						<div class="text-search"></div>

						<form class='search-box' id='searchforms' action="/hasil-pencarian/" method="GET">
							<p id="searchbart">
								<input class="input-search" id="txt_search" type="text" name="query" placeholder="Masukan Kata Pencarian.">
								<input type="submit" class="submit-search" value="Cari");">
							</p>
						</form>
					</div>
					<div class="fadeOut owl-carousel owl-theme">


						<div class="item">

							<img src='/images/Foto Beranda-1.jpg' />
							<div class="search" style="bottom:25%">
							<div class="text-search">
								{{-- <a href="" class="linkheader">

							<h2>PORTAL PENGAWASAN PNBP</h2>
							<span>Media Komunikasi dan Informasi APIP Kementerian/Lembaga dalam Pelaksanaan Pengawasan Pengelolaan PNBP</span>
							</a> --}}
						</div>
						</div>
						</div>
						<div class="item">

							<img src='/images/Foto Beranda-2.jpg' />
							<div class="search" style="bottom:25%">
							<div class="text-search">
						</div>
						</div>
						</div>
						<div class="item">

							<img src='/images/Foto Beranda-3.jpg' />
							<div class="search" style="bottom:25%">
							<div class="text-search">

						</div>
						</div>
                        </div>
                        <div class="item">

                                <img src='/images/Foto Beranda-4.jpg' />
                                <div class="search" style="bottom:25%">
                                <div class="text-search">
    
                            </div>
                            </div>
                            </div>
                            <div class="item">

                                    <img src='/images/Foto Beranda-5.jpg' />
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
			<div class="container">

					<div class="bgs122-title"></div>
					<span></span>

				<div class="bgs122-data">

					<marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
					<a href="#" target="_blank" style="margin-right:20px;">Batas akhir penyampaian laporan hasil pengawasan PNBP APIP K/L Tahun Anggaran 2019 yaitu 30 April 2020</a>
                   </marquee>

				</div>
			</div>
		</div>
		<div class="container">
			<form class='search-mobile' action="/hasil-pencarian/" method="GET">
				<p>
					<input type="text" id="txt_search" name="query" placeholder="Masukan Kata Pencarian Anda.">
					<span></span>
				</p>
			</form>
		</div>

		<section id="content">
			<div class="news-data owl-carousel owl-theme">
                <div class="item">
                        <div class="news" style="background:url('/images/artikel/1548732860.jpg')center center no-repeat;background-size:100%;">
                            <div class="mask">
                                <a href="http://www.menlhk.go.id/site/single_post/1830">Menyongsong Kebangkitan Industri Perkayuan Nasional untuk Kesejahteraan Masyarakat</a>

                                <!--<p>Jakarta, 15/08/2019 Kemenkeu - Bank Indonesia (BI) merilis angka utang Luar Negeri (ULN) Indonesia pada akhir triwulan II 2019 yang terkendali dengan struktur yang sehat. ULN Indonesia tercatat sebesar 391,8 miliar dolar AS yang terdiri dar&hellip;</p>-->
                                <a href="#" class="btn-merah-news">Indeks</a>
                            </div>
                        </div>
                </div>
				<div class="item">
                        <div class="news" style="background:url('/images/artikel/perikanan.jpg')center center no-repeat;background-size:100%;">
                            <div class="mask">
                                <a href="https://kkp.go.id/bkipm/artikel/7082-pnbp-sektor-perikanan-terus-alami-peningkatan">PNBP Sektor Perikanan Terus Alami Peningkatan</a>

                                <!--<p>Jakarta, 15/08/2019 Kemenkeu - Menteri Keuangan (Menkeu) Sri Mulyani Indrawati sebagai wakil Pemerintah Indonesia mengapresiasi hubungan bilateral antara Indonesia dan Singapura yang kuat. Sejak terbentuknya hubungan diplomatik antara kedua&hellip;</p>-->
                                <a href="#" class="btn-merah-news">Indeks</a>
                            </div>
                        </div>
                </div>
				<div class="item">
                        <div class="news" style="background:url('/images/artikel/tambang.jpg')center center no-repeat;background-size:100%;">
                            <div class="mask">
                                <a href="https://migas.esdm.go.id/post/read/harga-minyak-dunia-jadi-tantangan-pencapaian-pnbp-migas-2019">Harga Minyak Dunia Jadi Tantangan Pencapaian PNBP Migas 2019</a>

                                <!--<p>Jakarta, 14/08/2019 Kemenkeu - Saat ini, anggaran pembebasan lahan Proyek Strategis Nasional (PSN) semakin fleksibel untuk mempermudah proses pendanaan tanah dalam mempercepat pembangunan infrastruktur PSN.</p>-->
                                <a href="#" class="btn-merah-news">Indeks</a>
                            </div>
                        </div>
                </div>
			</div>
		<div class="container" style="background:white;">
				<div class="data-apbn">
								<h1 class="heading">DATA PNBP</h1>
                                    <div id="thumb_graph">
                                        <div class="graph_thumb owl-carousel owl-theme">
                                                <div class="th_3">

                                                    </div>
                                            <div class="item active th_1">
                                                <a onclick="javascript:load_graph('1','1');" href="javascript:void(0);">
                                                    <img src="/media/5793/apbn.jpg">
                                                </a>
                                            </div>
                                            <div class="item active th_2">
                                                <a onclick="javascript:load_graph('2','2');" href="javascript:void(0);">
                                                    <img src="/media/5794/infrastruktur.jpg">
                                                </a>
                                            </div>

                                            <div class="th_4">

                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="heading gra active" id="graphshead1">Tren PNBP per Jenis PNBP <p style="font-size:60%">Tahun 2014 s.d. 2018</p></h2>
                                    <h2 class="heading gra" id="graphshead2">Tren Perbandingan PNBP dengan Penerimaan Negara <p style="font-size:60%">Tahun 2014 s.d. 2018</p></h2>
                                    <h2 class="heading gra" id="graphshead3"> </h2>
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
						        var chartData = [

                                                {
                                                "Tahun PNBP": "2014",
                                                "Penerimaan SDA": 240.85,
                                                "Belanja Pemerintah atas Laba BUMN": 40.31,
                                                "Pendapatan dari Kekayaan Negara Dipisahkan": 0,
                                                "PNBP Lainnya": 87.75,
                                                "Pendapatan BLU": 29.68,
                                                "Total": 398.59
                                                },
                                                {
                                                "Tahun PNBP": "2015",
                                                "Penerimaan SDA": 100.97,
                                                "Belanja Pemerintah atas Laba BUMN": 37.64,
                                                "Pendapatan dari Kekayaan Negara Dipisahkan": 0,
                                                "PNBP Lainnya": 81.7,
                                                "Pendapatan BLU": 35.32,
                                                "Total": 255.63
                                                },
                                                {
                                                "Tahun PNBP": "2016",
                                                "Penerimaan SDA": 64.9,
                                                "Belanja Pemerintah atas Laba BUMN": 37.13,
                                                "Pendapatan dari Kekayaan Negara Dipisahkan": 0,
                                                "PNBP Lainnya": 118,
                                                "Pendapatan BLU": 41.95,
                                                "Total": 261.98
                                                },
                                                {
                                                "Tahun PNBP": "2017",
                                                "Penerimaan SDA": 111.13,
                                                "Belanja Pemerintah atas Laba BUMN": 43.9,
                                                "Pendapatan dari Kekayaan Negara Dipisahkan": 0,
                                                "PNBP Lainnya": 108.84,
                                                "Pendapatan BLU": 47.35,
                                                "Total": 311.22
                                                },
                                                {
                                                "Tahun PNBP": "2018",
                                                "Penerimaan SDA": 180.6,
                                                "Belanja Pemerintah atas Laba BUMN": 0,
                                                "Pendapatan dari Kekayaan Negara Dipisahkan": 45.06,
                                                "PNBP Lainnya": 128.57,
                                                "Pendapatan BLU": 55.09,
                                                "Total": 409.32
                                                }

                                        ];
							AmCharts.ready(function () {
							chart = new AmCharts.AmSerialChart();
							chart.dataProvider = chartData;
							chart.categoryField = "Tahun PNBP";
							chart.color = "#222222";
							chart.fontSize = 14;
							chart.startDuration = 1;
							chart.plotAreaFillAlphas = 0.2;
							chart.angle = 30;

								chart.depth3D = 0;



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
                            graph0.dashLengthField = "dashLengthLine";
                            chart.addGraph(graph0);

                            var legend = new AmCharts.AmLegend();
							legend.useGraphSettings = true;
							chart.addLegend(legend);
							chart.write("graphs1");
						});
						var chartData2 = [

								{
								"Tahun": "2014",
                                "Realisasi PNBP": 398.6,
                                "Realisasi Pendapatan Negara": 1550.5 },
								{
								"Tahun": "2015",
								"Realisasi PNBP": 255.6,
                                "Realisasi Pendapatan Negara": 1508 },
								{
								"Tahun": "2016",
								"Realisasi PNBP": 261.9,
                                "Realisasi Pendapatan Negara": 1555.9 },
								{
								"Tahun": "2017",
								"Realisasi PNBP": 308.4,
                                "Realisasi Pendapatan Negara": 1655.8 },
								{
								"Tahun": "2018",
								"Realisasi PNBP": 409.3,
                                "Realisasi Pendapatan Negara": 1943.7 },

						];
						AmCharts.ready(function () {
							chart = new AmCharts.AmSerialChart();

							chart.dataProvider = chartData2;
							chart.categoryField = "Tahun";
							chart.startDuration = 1;

							//chart.handDrawn = true;
							//chart.handDrawnScatter = 3;
							chart.angle = 25;

								chart.depth3D = 0;



							var categoryAxis = chart.categoryAxis;
							categoryAxis.gridPosition = "start";





							var graph1 = new AmCharts.AmGraph();
							graph1.type = "line";
							graph1.title = "Realisasi PNBP";
							graph1.lineColor = "#FF0017";
							graph1.valueField = "Realisasi PNBP";
							graph1.lineThickness = 10;


							graph1.customBullet = "/images/point_hijau.png";
                            graph1.bulletSize = 50;
							graph1.dashLengthField = "dashLengthLine";


							var graph2 = new AmCharts.AmGraph();
							graph2.type = "line";
							graph2.title = "Realisasi Pendapatan Negara";
							graph2.lineColor = "#194C85";
							graph2.valueField = "Realisasi Pendapatan Negara";
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



                            <p>Sumber: LKPP Audited </p>
				</div>

			</div>
                        <div class="clear">&nbsp;</div>
						<div class="bgs123">
							<div class="container">

									<center class="bgs123-data"><b>Hasil Pengawasan APIP K/L TA 2018</b></center>
							</div>
                        </div>
                        <!-- amCharts javascript sources -->
                        <script src="/vendor/amcharts/amcharts/pie.js" type="text/javascript"></script>
                        <!-- amCharts javascript code -->
                            <script type="text/javascript">
                                AmCharts.makeChart("piegraphs3",
                                    {
                                        "type": "pie",
                                        "adjustPrecision": false,
                                        "angle": 60,
                                        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[percents]]%</b></span>",
                                        "depth3D": 60,
                                        "labelRadius": 35,
                                        "labelText": "[[percents]]%<br>[[title]]",
                                        "colors": [
                                            "#88E0B0",
                                            "#FF5771",
                                            "#FFCF00",
                                            "#5FABBB"
                                        ],
                                        "titleField": "status",
                                        "valueField": "value",
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
                                                "text": "Status Tindak Lanjut Temuan Pengawasan PNBP"
                                            }
                                        ],
                                        "dataProvider": [
                                            {
                                                "status": "Tuntas",
                                                "value": "0.5"
                                            },
                                            {
                                                "status": "Belum Tuntas",
                                                "value": "0.24"
                                            },
                                            {
                                                "status": "Belum Ditindaklanjuti",
                                                "value": "0.16"
                                            },
                                            {
                                                "status": "Tidak Dapat Ditindaklanjuti",
                                                "value": "0.1"
                                            }
                                        ]
                                    }
                                );
                            </script>

                        <!-- amCharts javascript code -->
                        <script type="text/javascript">
                            AmCharts.makeChart("piegraphs4",
                                {
                                    "type": "pie",
                                    "adjustPrecision": false,
                                    "angle": 60,
                                    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[percents]]%</b></span>",
                                    "depth3D": 60,
                                    "labelRadius": 35,
                                    "labelText": "[[percents]]%<br>[[title]]",
                                    "colors": [
                                        "#6ABBFC",
                                        "#FFE457",
                                        "#2DFF00",
                                        "#8D95F8"
                                    ],
                                    "titleField": "category",
                                    "valueField": "column-1",
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
                                            "text": "Temuan Pengawasan PNBP"
                                        }
                                    ],
                                    "dataProvider": [
                                        {
                                            "category": "Kelemahan SPI",
                                            "column-1": "0.5"
                                        },
                                        {
                                            "category": "Temuan 3E",
                                            "column-1": "0.24"
                                        },
                                        {
                                            "category": "Potensi Kerugian Negara",
                                            "column-1": "0.16"
                                        },
                                        {
                                            "category": "Kerugian Negara",
                                            "column-1": "0.1"
                                        }
                                    ]
                                }
                            );
                        </script>
                        <div class="cls-lintas" style="background:white;">
                            
                                        <div id="piegraphs3" class="col-md-6"></div>
                                        <div id="piegraphs4" class="col-md-6"></div>
                                    
                        </div>
                        <div class="clear">&nbsp;</div>
						<div class="bgs123">
							<div class="container">

									<center class="bgs123-data"><b>Infografis PNBP</b></center>
							</div>
                        </div>
                        <div class="infografis owl-carousel owl-theme">
                            <div class="item">
                                    <div class="news" style="background:url('/media/infografis/preview/Infografis Realisasi PNBP TA 2018.jpg')center center no-repeat;background-size:100%;">
                                        <div class="mask">
                                            <a href=""></a>
                                            <a href="/media/infografis/Infografis Realisasi PNBP TA 2018.pdf" class="btn-merah-news" target="_blank">Unduh</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="item">
                                    <div class="news" style="background:url('/media/infografis/preview/Infografis Ruang Lingkup Pengawasan PNBP.jpg')center center no-repeat;background-size:100%;">
                                        <div class="mask">
                                            <a href=""></a>
            
                                            <a href="/media/infografis/Infografis Ruang Lingkup Pengawasan PNBP.pdf" target="_blank" class="btn-merah-news">Unduh</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="item">
                                <div class="news" style="background:url('/media/infografis/preview/Infografis Realisasi Semester I 2019.jpg')center center no-repeat;background-size:100%;">
                                    <div class="mask">
                                        <a href=""></a>
        
                                    <a href="/media/infografis/Infografis Realisasi Semester I 2019.pdf" target="_blank" class="btn-merah-news">Unduh</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="news" style="background:url('/media/infografis/preview/Infografis Pengelolaan BMN.jpg')center center no-repeat;background-size:100%;">
                                    <div class="mask">
                                        <a href=""></a>
        
                                    <a href="/media/infografis/Infografis Pengelolaan BMN.jpg" target="_blank" class="btn-merah-news">Unduh</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="news" style="background:url('/media/infografis/preview/Infografis PNBP Kominfo.jpg')center center no-repeat;background-size:100%;">
                                    <div class="mask">
                                        <a href=""></a>
        
                                    <a href="/media/infografis/Infografis PNBP Kominfo.jpg" target="_blank" class="btn-merah-news">Unduh</a>
                                    </div>
                                </div>
                            </div>
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
                                        <font>Peraturan Terkait PNBP dari Berbagai Kementerian/Lembaga</font>
                                        <a href="">Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="infografis owl-carousel owl-theme">
                            <div class="item">
                                <div class="newsv">
                                    <video id='my-video' class='video-js vjs-default-skin vjs-4-3 vjs-big-play-centered' controls preload='auto' responsive='true'
                                    width='480' height='480' poster='/media/video/preview/PNBP.jpg' data-setup='{"fluid": true}'>
                                        <source src='/media/video/PNBP.mp4' type='video/mp4'>
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
                                            width='480' height='480' poster='/media/video/preview/KC-1-Pak-Zun.jpg' data-setup='{"fluid": true}'>
                                                <source src='/media/video/KC-1-Pak-Zun.mp4' type='video/mp4'>
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
                                            width='480' height='480' poster='/media/video/preview/KC-1-Pak-Luhut-conv.jpg' data-setup='{"fluid": true}'>
                                                <source src='/media/video/KC-1-Pak-Luhut-conv.mp4' type='video/mp4'>
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
                                            width='480' height='480' poster='/media/video/preview/4.-Noor-Cholis-Madjid-Tugas-dan-Wewenang-Menteri-Keuangan-dalam-Pengelolaan-PNBP.jpg' data-setup='{"fluid": true}'>
                                                <source src='/media/video/4.-Noor-Cholis-Madjid-Tugas-dan-Wewenang-Menteri-Keuangan-dalam-Pengelolaan-PNBP.mp4' type='video/mp4'>
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
                                            width='480' height='480' poster='/media/video/preview/4.-Heryanto-Sijabat-MPN-G2.jpg' data-setup='{"fluid": true}'>
                                                <source src='/media/video/4.-Heryanto-Sijabat-MPN-G2.mp4' type='video/mp4'>
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


@endsection
