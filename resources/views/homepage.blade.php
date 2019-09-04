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

							<img src='/media/12992/sliderhutri74.png' />
							<div class="search" style="bottom:25%">
							<div class="text-search">
								<a href="/hutri74" target="_blank" class="linkheader">

							<h3>HUT RI 74</h3>
							<span>SDM Unggul, Indonesia Maju</span>
							</a>
						</div>
						</div>
						</div>
						<div class="item">

							<img src='/media/13047/slider-st005.jpg' />
							<div class="search" style="bottom:25%">
							<div class="text-search">
								<a href="/sukuktabungan" target="_blank" class="linkheader">

							<h3>#JadiLebihBijak</h3>
							<span>Investasi Cinta Negeri, Melalui #ST005</span>
							</a>
						</div>
						</div>
						</div>
						<div class="item">

							<img src='/media/12833/slider-web-apbn-kita-juli.jpg' />
							<div class="search" style="bottom:25%">
							<div class="text-search">
								<a href="https://www.kemenkeu.go.id/apbnkita" target="_blank" class="linkheader">

							<h3>#APBNKiTa</h3>
							<span>Awasi kinerja APBN melalui APBN Kinerja dan Fakta (Kita) </span>
							</a>
						</div>
						</div>
						</div>
						<div class="item">

							<img src='/media/12684/slider-lombafotoptsmi.png' />
							<div class="search" style="bottom:25%">
							<div class="text-search">
								<a href="https://www.kemenkeu.go.id/lombafotoinfrastruktur2019" target="_blank" class="linkheader">

							<h3>#LombaFoto</h3>
							<span>Ayo, ikutan lomba foto Kemenkeu PT SMI dengan share foto infrastruktur di instagram kamu sekarang, jadilah pemenang, dan dapatkan hadiah menarik!</span>
							</a>
						</div>
						</div>
						</div>

					</div>
					<div class="bg_slider"></div>
			</div>

		<div class="clear"></div>
		<script type="text/javascript">
			var player;
			function onYouTubeIframeAPIReady() {
				player = new YT.Player('ytplayer', {
					events: {
						'onReady': onPlayerReady
					}
				});
			}

			function onPlayerReady(event) {
				player.mute();
				player.playVideo();
			}
		</script>
        <div class="bgs122">
			<div class="container">

					<div class="bgs122-title"></div>
					<span></span>

				<div class="bgs122-data">

					<marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
					<a href="" target="_blank" style="margin-right:20px;"></a>
					<a href="/lombafotoinfrastruktur2019" target="_blank" style="margin-right:20px;">Ayo ikutan LombaFotoKemenkeuPTSMI</a>
					<a href="/apbn2019" target="_blank" style="margin-right:20px;">Info Lengkap #APBN2019</a>
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
			<div class="news-data">
					<div class="news" style="background:url('/media/10103/ilustrasi-bi.jpg')center center no-repeat;background-size:100%;">
								<div class="mask">
									<a href="/publikasi/berita/utang-luar-negeri-indonesia-triwulan-ii-2019-terkendali/">Utang Luar Negeri Indonesia Triwulan II 2019 Terkendali</a>

									<!--<p>Jakarta, 15/08/2019 Kemenkeu - Bank Indonesia (BI) merilis angka utang Luar Negeri (ULN) Indonesia pada akhir triwulan II 2019 yang terkendali dengan struktur yang sehat. ULN Indonesia tercatat sebesar 391,8 miliar dolar AS yang terdiri dar&hellip;</p>-->
									<a href="publikasi/berita" class="btn-merah-news">Indeks</a>
								</div>
							</div>
					<div class="news" style="background:url('/media/13077/pm-singapore-menkeu-sri-mulyani-ulang-tahun-singapura.jpg')center center no-repeat;background-size:100%;">
								<div class="mask">
									<a href="/publikasi/berita/peringati-hari-kemerdekaan-singapura-menkeu-apresiasi-hubungan-bilateral-kedua-negara/">Peringati Hari Kemerdekaan Singapura, Menkeu Apresiasi Hubungan Bilateral Kedua Negara</a>

									<!--<p>Jakarta, 15/08/2019 Kemenkeu - Menteri Keuangan (Menkeu) Sri Mulyani Indrawati sebagai wakil Pemerintah Indonesia mengapresiasi hubungan bilateral antara Indonesia dan Singapura yang kuat. Sejak terbentuknya hubungan diplomatik antara kedua&hellip;</p>-->
									<a href="publikasi/berita" class="btn-merah-news">Indeks</a>
								</div>
							</div>
					<div class="news" style="background:url('/media/13074/anggaran-pengadaan-tanah.jpg')center center no-repeat;background-size:100%;">
								<div class="mask">
									<a href="/publikasi/berita/anggaran-pengadaan-tanah-makin-fleksibel-untuk-proyek-strategis-nasional/">Anggaran Pengadaan Tanah Makin Fleksibel Untuk Proyek Strategis Nasional</a>

									<!--<p>Jakarta, 14/08/2019 Kemenkeu - Saat ini, anggaran pembebasan lahan Proyek Strategis Nasional (PSN) semakin fleksibel untuk mempermudah proses pendanaan tanah dalam mempercepat pembangunan infrastruktur PSN.</p>-->
									<a href="publikasi/berita" class="btn-merah-news">Indeks</a>
								</div>
							</div>

							<div class="clear"></div>

			</div>
			<div class="container" style="background:white;">
							<div class="data-apbn">
								<h1 class="heading">DATA APBN</h1>
								<p>APBN adalah #UangKita.


			Uang rakyat Indonesia yang digunakan sebesar-besarnya demi kesejahteraan masyarakat Indonesia. </p>
								<div class="clear"></div>
								<script src="/vendor/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
					<script src="/vendor/amcharts/amcharts/serial.js" type="text/javascript"></script>

								<script type="text/javascript">
								var chart;
						var chartData = [

								{
								"Tahun APBN": "2015",
								"Pendapatan Negara": 1793.6,
								"Belanja Negara": 2039.5 },
								{
								"Tahun APBN": "2016",
								"Pendapatan Negara": 1822.5,
								"Belanja Negara": 2095.7 },
								{
								"Tahun APBN": "2017",
								"Pendapatan Negara": 1750.3,
								"Belanja Negara": 2080.5 },
								{
								"Tahun APBN": "2018",
								"Pendapatan Negara": 1894.7,
								"Belanja Negara": 2220.7 },
								{
								"Tahun APBN": "2019",
								"Pendapatan Negara": 2165.1,
								"Belanja Negara": 2461.1 },

						];
							AmCharts.ready(function () {
							chart = new AmCharts.AmSerialChart();
							chart.dataProvider = chartData;
							chart.categoryField = "Tahun APBN";
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
							valueAxis.stackType = "3d";
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
							graph1.title = "Pendapatan Negara";
							graph1.valueField = "Pendapatan Negara";
							graph1.type = "column";
							graph1.lineAlpha = 0;
							graph1.lineColor = "#194C85";
							graph1.fillAlphas = 1;
							graph1.balloonText = "Pendapatan Negara APBN : [[value]]";
							chart.addGraph(graph1);

							var graph2 = new AmCharts.AmGraph();
							graph2.title = "Belanja Negara";
							graph2.valueField = "Belanja Negara";
							graph2.type = "column";
							graph2.lineAlpha = 0;
							graph2.lineColor = "#FFCB05";
							graph2.fillAlphas = 1;
							graph2.balloonText = "Belanja Negara APBN : [[value]]";
							chart.addGraph(graph2);

							chart.write("graphs1");
						});
						var chartData2 = [

								{
								"Tahun": "2015",
								"Anggaran Infrastruktur": 256.1 },
								{
								"Tahun": "2016",
								"Anggaran Infrastruktur": 269.1 },
								{
								"Tahun": "2017",
								"Anggaran Infrastruktur": 388.3 },
								{
								"Tahun": "2018",
								"Anggaran Infrastruktur": 410.7 },
								{
								"Tahun": "2019",
								"Anggaran Infrastruktur": 415.0 },

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
							graph1.title = "Anggaran Infrastruktur";
							graph1.lineColor = "#194C85";
							graph1.valueField = "Anggaran Infrastruktur";
							graph1.lineThickness = 3;


								graph1.bullet = "round";
							graph1.bulletBorderThickness = 3;
							graph1.bulletBorderColor = "#fcd202";
							graph1.bulletBorderAlpha = 1;
							graph1.bulletColor = "#ffffff";
							graph1.dashLengthField = "dashLengthLine";



							var valueAxis = new AmCharts.ValueAxis();
							valueAxis.stackType = "3d";
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
							chart.addGraph(graph1);

							var legend = new AmCharts.AmLegend();
							legend.useGraphSettings = true;
							chart.addLegend(legend);

							chart.write("graphs2");
						})

						var chartData3 = [

								{
								"Tahun": "2015",
								"Anggaran Pendidikan": 409.1 },
								{
								"Tahun": "2016",
								"Anggaran Pendidikan": 419.2 },
								{
								"Tahun": "2017",
								"Anggaran Pendidikan": 416.1 },
								{
								"Tahun": "2018",
								"Anggaran Pendidikan": 444.1 },
								{
								"Tahun": "2019",
								"Anggaran Pendidikan": 492.5 },

						];
						AmCharts.ready(function () {
							chart = new AmCharts.AmSerialChart();

							chart.dataProvider = chartData3;
							chart.categoryField = "Tahun";
							chart.startDuration = 1;

							//chart.handDrawn = true;
							//chart.handDrawnScatter = 3;
							chart.angle = 35;
							//chart.depth3D = 20;

							var categoryAxis = chart.categoryAxis;
							categoryAxis.gridPosition = "start";

							var valueAxis = new AmCharts.ValueAxis();
							valueAxis.stackType = "3d";
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
							graph1.type = "line";
							graph1.title = "Anggaran Pendidikan";
							graph1.lineColor = "#194C85";
							graph1.valueField = "Anggaran Pendidikan";
							graph1.lineThickness = 3;


								graph1.bullet = "round";
							graph1.bulletBorderThickness = 3;
							graph1.bulletBorderColor = "#fcd202";
							graph1.bulletBorderAlpha = 1;
							graph1.bulletColor = "#ffffff";
							graph1.dashLengthField = "dashLengthLine";


							graph1.balloonText = "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span>";
							chart.addGraph(graph1);

							var legend = new AmCharts.AmLegend();
							legend.useGraphSettings = true;
							chart.addLegend(legend);

							chart.write("graphs3");
						})

						var chartData4 = [

								{
								"Tahun": "2015",
								"Anggaran Kesehatan": 65.9 },
								{
								"Tahun": "2016",
								"Anggaran Kesehatan": 92.3 },
								{
								"Tahun": "2017",
								"Anggaran Kesehatan": 104.9 },
								{
								"Tahun": "2018",
								"Anggaran Kesehatan": 111.0 },
								{
								"Tahun": "2019",
								"Anggaran Kesehatan": 123.1 },

						];
						AmCharts.ready(function () {
							chart = new AmCharts.AmSerialChart();

							chart.dataProvider = chartData4;
							chart.categoryField = "Tahun";
							chart.startDuration = 1;

							//chart.handDrawn = true;
							//chart.handDrawnScatter = 3;
							chart.angle = 25;
							//chart.depth3D = 20;

							var categoryAxis = chart.categoryAxis;
							categoryAxis.gridPosition = "start";

							var valueAxis = new AmCharts.ValueAxis();
							valueAxis.stackType = "3d";
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
							graph1.type = "column";
							graph1.title = "Anggaran Kesehatan";
							graph1.lineColor = "#194C85";
							graph1.valueField = "Anggaran Kesehatan";
							graph1.lineThickness = 3;



								graph1.fillAlphas = 1;


							graph1.balloonText = "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span>";
							chart.addGraph(graph1);

							var legend = new AmCharts.AmLegend();
							legend.useGraphSettings = true;
							chart.addLegend(legend);

							chart.write("graphs4");
						})

								</script>


								<div class="gr">
								<div id="graphs1" class="gr active"></div>
								<div id="graphs2" class="gr"></div>
								<div id="graphs3" class="gr"></div>
								<div id="graphs4" class="gr"></div>
								<div id="graphs5" class="gr"></div>
								<div id="graphs6" class="gr"></div>
								</div>

								<h2 class="heading gra active" id="graphshead1">APBN dari Tahun ke Tahun </h2>
								<h2 class="heading gra" id="graphshead2">Anggaran Infrastruktur </h2>
								<h2 class="heading gra" id="graphshead3">Anggaran Pendidikan </h2>
								<h2 class="heading gra" id="graphshead4">Anggaran Kesehatan </h2>
								<h2 class="heading gra" id="graphshead5"> </h2>
								<h2 class="heading gra" id="graphshead6"> </h2>
								<div id="thumb_graph">
									<div class="graph_thumb owl-carousel owl-theme">
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
										<div class="item active th_3">
											<a onclick="javascript:load_graph('3','3');" href="javascript:void(0);">
												<img src="/media/5796/pendidikan.jpg">
											</a>
										</div>
										<div class="item active th_4">
											<a onclick="javascript:load_graph('4','4');" href="javascript:void(0);">
												<img src="/media/5795/kesehatan.jpg">
											</a>
										</div>
									</div>
								</div>
								<div class="clear"></div>
								<div class="text-center">
									<a href="https://www.kemenkeu.go.id/dataapbn" class="btn-merah gra active" id="graphslink1">Selengkapnya <span></span></a>
									<a href="https://www.kemenkeu.go.id/dataapbn" class="btn-merah gra" id="graphslink2">Selengkapnya <span></span></a>
									<a href="https://www.kemenkeu.go.id/dataapbn" class="btn-merah gra" id="graphslink3">Selengkapnya <span></span></a>
									<a href="https://www.kemenkeu.go.id/dataapbn" class="btn-merah gra" id="graphslink4">Selengkapnya <span></span></a>
									<a href="" class="btn-merah gra" id="graphslink5">Selengkapnya <span></span></a>
									<a href="" class="btn-merah gra" id="graphslink6">Selengkapnya <span></span></a>
								</div>
								<div class="height-100"></div>
							</div>

						</div>

			<div class="data-info" style="background:#FAFAFA !important;">
							<div class="container">
								<div class="text-center">
									<h2 class="heading">Informasi Terbaru<br><span class="gray-14">Pengumuman | Siaran Pers | Kurs Pajak | Artikel & Opini | Berita Unit </span></h2>
								</div>
								<div class="tab-top">
									<a class="tab tb_1 active" onclick="javascript:load_info('1');" href="javascript:void(0);"><span class="ico-pengumuman"></span>Pengumuman</a>
									<a class="tab tb_2" onclick="javascript:load_info('2');" href="javascript:void(0);"><span class="ico-siaran-pers"></span>Siaran Pers</a>
									<a class="tab tb_3" onclick="javascript:load_info('3');" href="javascript:void(0);"><span class="ico-kurs-pajak"></span>Kurs Pajak</a>
									<a class="tab tb_4" onclick="javascript:load_info('4');" href="javascript:void(0);"><span class="ico-artikel-opini"></span>Artikel & Opini</a>
									<a class="tab tb_5" onclick="javascript:load_info('5');" href="javascript:void(0);"><span class="ico-berita-unit"></span>Berita Unit</a>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
								<div class="tab-content">
									<div id="ct_1" class="ct active">
										<div class="pengumuman">
										<div class="col-20">
											<a href="/publikasi/pengumuman/tender-dengan-pascakualifikasi-pengadaan-jasa-konstruksi-pekerjaan-fisik-ta-2019/"><b>07/08/2019</b>
											<p>Tender Dengan Pascakualifikasi Pengadaan Jasa Kons&hellip;</p></a>

										</div>
										<div class="col-20">
											<a href="/publikasi/pengumuman/pengadaan-psikotes-online-seleksi-penerimaan-mahasiswa-baru-politeknik-keuangan-negara-stan-ta-2019/"><b>31/07/2019</b>
											<p>Pengadaan Psikotes Online Seleksi Penerimaan Mahas&hellip;</p></a>

										</div>
										<div class="col-20">
											<a href="/publikasi/pengumuman/pengadaan-perangkat-security-management-kemenkeu-ta-2019/"><b>24/06/2019</b>
											<p>Pengadaan Perangkat Security Management Kemenkeu T&hellip;</p></a>

										</div>
										<div class="col-20">
											<a href="/publikasi/pengumuman/seleksi-terbuka-pengisian-jabatan-pimpinan-tinggi-pratama-kemendesa-2019/"><b>29/05/2019</b>
											<p>Seleksi Terbuka Pengisian Jabatan Pimpinan Tinggi&hellip;</p></a>

										</div>
									<div class="clear"></div>
									</div>
									<div class="text-center">
										<a href="/publikasi/pengumuman" class="btn-merah">Selengkapnya <span></span></a>
									</div>
									<div class="height-100"></div>
									</div>
									<div id="ct_2" class="ct nonactive">
										<div class="pengumuman">
										<div class="col-20">
											<a href="/publikasi/siaran-pers/penjelasan-tentang-kenaikan-tunjangan-direksi-dan-dewan-pengawas-bpjs/"><b>13/08/2019</b>
											<p>Penjelasan Tentang Kenaikan Tunjangan Direksi dan&hellip;</p></a>

										</div>
										<div class="col-20">
											<a href="/publikasi/siaran-pers/kemenkeu-ajak-pemuda-pemudi-pontianak-kurangi-sampah-plastik/"><b>03/08/2019</b>
											<p>Kemenkeu Ajak Pemuda Pemudi Pontianak Kurangi Samp&hellip;</p></a>

										</div>
										<div class="col-20">
											<a href="/publikasi/siaran-pers/siaran-pers-blending-islamic-finance-dan-impact-investment-untuk-pembangunan-berkelanjutan/"><b>24/07/2019</b>
											<p>Siaran Pers : Blending Islamic Finance dan Impact&hellip;</p></a>

										</div>
										<div class="col-20">
											<a href="/publikasi/siaran-pers/siaran-pers-lantik-dirjen-perbendaharaan-baru-menkeu-jaga-governance-belanja-negara/"><b>22/07/2019</b>
											<p>Siaran Pers : Lantik Dirjen Perbendaharaan Baru, M&hellip;</p></a>

										</div>
									<div class="clear"></div>
									</div>

									<div class="text-center">
										<a href="/publikasi/siaran-pers" class="btn-merah">Selengkapnya <span></span></a>
									</div>
									<div class="height-100"></div>
									</div>
									<div id="ct_3" class="ct nonactive">
									<img src="/media/9998/img-kurs-pajak.jpeg"  width="100%"/>
									<!--<h3 style="text-align:center;"> Informasi terkait kurs pajak dapat diakses pada situs web Badan Kebijakan Fiskal pada tautan dibawah ini.
									</h3>-->
									<!-- backup script -->
									<!-- -->
									<div class="text-center">
										<a href="http://www.fiskal.kemenkeu.go.id/dw-kurs-db.asp" class="btn-merah">Selengkapnya <span></span></a>
									</div>
									<div class="height-100"></div>
									</div>
									<div id="ct_4" class="ct nonactive">
										<div class="pengumuman">
										<div class="col-20">

											<a href="/publikasi/artikel-dan-opini/sukuk-daur-ulang-dukungan-fiskal-syariah-untuk-ekonomi-sirkular/">
			<b>28/06/2019</b>
											<p>Sukuk Daur Ulang, Dukungan Fiskal Syariah untuk Ek&hellip;</p></a>

										</div>
										<div class="col-20">

											<a href="/publikasi/artikel-dan-opini/hubungan-penerimaan-ppn-dan-tingkat-konsumsi-masyarakat/">
			<b>06/05/2019</b>
											<p>Hubungan Penerimaan PPN dan Tingkat Konsumsi Masya&hellip;</p></a>

										</div>
										<div class="col-20">

											<a href="/publikasi/artikel-dan-opini/mengenal-dak-dan-kebijakan-baru-dak-non-fisik-2019/">
			<b>06/05/2019</b>
											<p>Mengenal Dak Dan Kebijakan Baru Dak Non Fisik 2019&hellip;</p></a>

										</div>
										<div class="col-20">

											<a href="/publikasi/artikel-dan-opini/bangkitkan-ruh-kemandirian/">
			<b>23/04/2019</b>
											<p>Bangkitkan Ruh Kemandirian</p></a>

										</div>
									<div class="clear"></div>
									</div>

									<div class="text-center">

										<a href="/publikasi/artikel-dan-opini" class="btn-merah">Selengkapnya <span></span></a>
									</div>
									<div class="height-100"></div>
									</div>
									<div id="ct_5" class="ct nonactive">
										<div class="pengumuman">
										<div class="col-20">
											<a href="/publikasi/berita-unit/ojk-luncurkan-buku-literasi-bertemakan-pajak/"><b>06/08/2019</b>
											<p>OJK Luncurkan Buku Literasi Bertemakan Pajak</p></a>

										</div>
										<div class="col-20">
											<a href="/publikasi/berita-unit/ini-kandidat-kantor-wilayah-terbaik-tahun-2019/"><b>01/08/2019</b>
											<p>Ini Kandidat Kantor Wilayah Terbaik Tahun 2019</p></a>

										</div>
										<div class="col-20">
											<a href="/publikasi/berita-unit/kemenkeu-siap-rangkul-pemda-kembangkan-umkm/"><b>26/07/2019</b>
											<p>Kemenkeu Siap Rangkul Pemda Kembangkan UMKM</p></a>

										</div>
										<div class="col-20">
											<a href="/publikasi/berita-unit/peringati-hari-anak-nasional-dirjen-kn-serahkan-buku-cergam-ke-menkeu/"><b>23/07/2019</b>
											<p>Peringati Hari Anak Nasional, Dirjen KN Serahkan B&hellip;</p></a>

										</div>
									<div class="clear"></div>
									</div>

									<div class="text-center">
										<a href="/publikasi/berita-unit" class="btn-merah">Selengkapnya <span></span></a>
									</div>
									<div class="height-100"></div>
									</div>
								</div>
							</div>
						</div>

			<div class="cls-simapbn">
				<div style="text-align:center;margin-bottom:15px;">
					<h2>Simulasi APBN</h2>
					<h3>Saatnya kamu jadi Menteri Keuangan</h3>
				</div>

				<a href="http://simulasiapbn.kemenkeu.go.id">Lihat...</a>
				<div class="overlay"></div>

				</div>

			<div class="cls-peraturan">
							<div class="container">
								<div class="text-center">
									<h2 class="heading color-white">Peraturan Terbaru</h2>
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
											<font>	Informasi Peraturan Menteri Keuangan dan peraturan perundang-undangan lainnya dapat diakses melalui situs web Jaringan Dokumentasi dan Informasi Hukum (JDIH).</font>
											<a href="http://www.jdih.kemenkeu.go.id/">Situs Web JDIH    <span></span></a>
										</div>
									</div>
								</div>
							</div>
						</div>
			<div class="cls-vk">
				<div style="text-align:center;margin-bottom:15px;">
					<img src="/media/10993/vk_white-01.png" style="max-width:300px; width:100%;">
					<h2>Edukasi Interaktif Kemenkeu</h2>
				</div>

				<a href="http://visual.kemenkeu.go.id">Lihat...</a>
				<div class="overlay1"></div>
				<div class="overlay2"></div>
				</div>


			<div class="cls-magazine">
							<div class="kiri" style="background:#000 url('/media/12850/web-banner-agustus-01.jpg')right center no-repeat; background-size:100%;"></div>
							<div class="kanan">
								<div class="content">
									<h1>Media Keuangan</h1>

									<a href="/publikasi/e-magazine/media-keuangan/media-keuangan-edisi-agustus-2019/" class="top">
									Menjaga Arah Kebijakan</a>
									<span>Media Keuangan Edisi Agustus 2019</span>
									<p></p>
									<div><a href="/media/12958/mk-agustus-2019-upload2.pdf" class="btn btn-merah" download>Unduh</a>
									<a href="/publikasi/e-magazine/media-keuangan/" class="btn btn-merah" style="margin-left:10px">Edisi Lainnya</a>
									<a href="/publikasi/e-magazine/" class="btn-edisi">+ EMagazine</a></div>

								</div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>


			<div class="cls-lintas" style="background-color:white;">
							<div class="container">
								<div class="col-md-9">
									<div class="hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3a">
										<a href="http://e-ppid.kemenkeu.go.id/" class="hi-icon icon-1"><span class="font-12">Layanan Online Permohonan Informasi Publik</span></a>
										<a href="https://fiskal.kemenkeu.go.id/ejournal/" class="hi-icon icon-2"><span class="font-12">Kajian Ekonomi dan Keuangan</span></a>
										<a href="https://www.kemenkeu.go.id/informasi-publik/uu-apbn-dan-nota-keuangan/" class="hi-icon icon-3"><span class="font-12">APBN & Nota Keuangan</span></a>
										<a href="https://www.kemenkeu.go.id/publikasi/infografik/" class="hi-icon icon-4"><span class="font-12">Infografik</span></a>
										<a href="http://www.perpustakaan.kemenkeu.go.id/" class="hi-icon icon-5"><span>Perpustakaan Kementerian Keuangan</span></a>
										<a href="http://www.data-apbn.kemenkeu.go.id/" class="hi-icon icon-6"><span>Portal Data APBN</span></a>
										<a href="http://www.wise.kemenkeu.go.id/" class="hi-icon icon-7"><span>Whistleblowing System Kementerian Keuangan</span></a>
										<a href="/contact-us/" class="hi-icon icon-8"><span>Kontak</span></a>
										<a href="/layanan/layanan-bersama/" class="hi-icon icon-9"><span>Layanan</span></a>
										<a href="http://spanint.kemenkeu.go.id/spanint/" class="hi-icon icon-10"><span>Online Monitoring SPAN</span></a>
									</div>
									<div class="clear"></div>
									<div class="cls-eselon-1">
										<h1>Eselon 1</h1>
										<span>Kementerian Keuangan</span>
										<div class="clear"></div>
										<div class="data-eselon owl-carousel owl-theme">
											<div class="item">
												<a href="http://www.setjen.kemenkeu.go.id/">Sekretariat Jenderal</a>
											</div>
											<div class="item">
												<a href="http://www.itjen.kemenkeu.go.id/">Inspektorat Jenderal</a>
											</div>
											<div class="item">
												<a href="http://www.anggaran.kemenkeu.go.id/">Direktorat Jenderal Anggaran</a>
											</div>
											<div class="item">
												<a href="http://www.pajak.go.id/">Direktorat Jenderal Pajak</a>
											</div>
											<div class="item">
												<a href="http://www.beacukai.go.id/">Direktorat Jenderal Bea dan Cukai</a>
											</div>
											<div class="item">
												<a href="http://www.djpbn.kemenkeu.go.id/">Direktorat Jenderal Perbendaharaan</a>
											</div>
											<div class="item">
												<a href="http://www.djkn.kemenkeu.go.id/">Direktorat Jenderal Kekayaan Negara</a>
											</div>
											<div class="item">
												<a href="http://www.djpk.kemenkeu.go.id/">Direktorat Jenderal Perimbangan Keuangan</a>
											</div>
											<div class="item">
												<a href="http://www.djppr.kemenkeu.go.id/">Direktorat Jenderal Pengelolaan Pembiayaan dan Risiko</a>
											</div>
											<div class="item">
												<a href="https://fiskal.kemenkeu.go.id/">Badan Kebijakan Fiskal</a>
											</div>
											<div class="item">
												<a href="http://www.bppk.kemenkeu.go.id/">Badan Pendidikan dan Pelatihan Keuangan</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="data hi-icon-wrap hi-icon-effect-2 hi-icon-effect-2a">
										<h4 style="margin-top:10px;margin-bottom:10px;">Lintas Kementerian / Lembaga</h4>
										<marquee style="max-height: 430px;" direction = "up" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="6">
										<div class="lintas"></div>
										</marquee>
										<div class="clear"></div>
									</div>
								</div>
								<script>
				$(function(){
						$.ajax({
							url: "https://widget.kominfo.go.id/data/latest/gpr.xml",
							//url: "gpr.xml",
							type: "GET",
							dataType: "xml",
							success: function(data) {
								var item = $(data).find('item');
								if(item.length >1)
								{
									$(".lintas").html('');
									$(item).each(function(i, e) {
										var img = 'https://www.kominfo.go.id/images/icon_gpr/i4.png';
										var desc = $(this).find('description').text();
										$(".lintas").append(''+
				'<div class="rows">'+
				'	<div class="marquee-left">'+
						'<img src="'+img+'"/>'+
					'</div>'+
					'<div class="marquee-right">'+
					'<b>'+$(this).find('category_title').text()+'</b>'+
					'<span>'+$(this).find('pubDate').text()+'</span>'+
					'<a href="'+$(this).find('link').text()+'" target="blank">'+$(this).find('title').text()+'</a>'+
					'<div style="clear:both;height:20px;"></div>'+
					'</div>'+
				'</div>');
									//$(".lintas").append('<div><div class="widget-jcarrousel-content"><div class="widget-jcarrousel-content-kiri"><img src="'+img+'" style="width:45px;float:left;margin-right:6px;" /></div><div class="widget-jcarrousel-content-kanan" style="font-size:12px;text-align:justify;margin-left:46px;"><div class="widget-jcarrousel-content-kategori"><b>'+$(this).find('category_title').text()+'</b></div><div class="widget-jcarrousel-content-tanggal">'+$(this).find('pubDate').text()+'</div><div class="widget-jcarrousel-content-title"><a href="'+$(this).find('link').text()+'" target="blank">'+$(this).find('title').text()+'</a></div></div><div class="clear" style="height:20px;"></div></div>');
									});
								}
							}
						});
					});

				$(function() {
					$('marquee').mouseover(function() {
						$(this).attr('scrollamount',0);
					}).mouseout(function() {
						$(this).attr('scrollamount',5);
					});
				});
  				</script>
					<div class="clear"></div>
				</div>
			</div>
		</section>

        </div id="my-footer">
        <div>


		<section class="hidden-desk	">
				<div class="container">
					<div class="menu-home-mobile">
						<a href="https://www.kemenkeu.go.id/dataapbn"><div class="ico_1"><span>APBN</span></div></a>
						<a href="/publikasi/berita/"><div class="ico_2"><span>Berita Terbaru</span></div></a>
						<a href="http://simulasiapbn.kemenkeu.go.id"><div class="ico_sapbn"><span>Simulasi APBN</span></div>
						<a href="http://visual.kemenkeu.go.id"><div class="ico_vk"><span>Visual Kemenkeu</span></div>
						<!--<a href="#"><div class="ico_3"><span>Informasi Terbaru</span></div></a>-->
						<!--<a href="http://www.jdih.kemenkeu.go.id"><div class="ico_4"><span>Peraturan Terbaru</span></div></a>-->
						<!--<a href="http://spanint.kemenkeu.go.id/spanint/"><div class="ico_5"><span>Online Monitoring Span</span></div></a>-->
						<a href="/publikasi/e-magazine/"><div class="ico_6"><span>E-Magazine</span></div></a>
						<a href="/layanan/daftar-layanan/"><div class="ico_7"><span>Layanan</span></div></a>
						<a href="/publikasi/siaran-pers"><div class="ico_8"><span>Siaran Pers</span></div></a>
						<a href="http://www.fiskal.kemenkeu.go.id/dw-kurs-db.asp"><div class="ico_9"><span>Kurs Pajak</span></div></a>
						<div class="clear"></div>
					</div>
				</div>
		</section>
@endsection
