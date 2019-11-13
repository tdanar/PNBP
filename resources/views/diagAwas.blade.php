<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@push('head')

@endpush
@section('content')
<script src="/vendor/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="/vendor/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="/vendor/amcharts/amcharts/pie.js" type="text/javascript"></script>
<!-- amCharts javascript code-->
    <script type="text/javascript">
        var data1 = JSON.parse("{{$result1}}".replace(/&quot;/g,'"'));
        //console.log(data1);
        AmCharts.makeChart("piegraphs1",
            {
                "type": "pie",
                "theme": "none",
                "adjustPrecision": true,
                "colors": [
                                            "#88E0B0",
                                            "#FF5771",
                                            "#FFCF00",
                                            "#5FABBB"
                                        ],
                "titles": [
                                            {
                                                "id": "judul",
                                                "size": 15,
                                                "text": "Berdasarkan Jenis Pengawasan"
                                            }
                                        ],
                "percentPrecision": 0,
	            "thousandsSeparator": ".",
                "dataProvider": data1,
                "valueField": "Jumlah",
                "titleField": "Jenis Pengawasan",
                "outlineAlpha": 0.4,
                "depth3D": 15,
                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[title]]</b> ([[percents]]%)</span>",
                "angle": 5,
                "labelsEnabled": false
            }
        );
    </script>

<!-- amCharts javascript code-->
<script type="text/javascript">
    var data2 = JSON.parse("{{$result2}}".replace(/&quot;/g,'"'));
    //console.log(data2);
    AmCharts.makeChart("piegraphs2",
        {
            "type": "pie",
            "theme": "none",
            "adjustPrecision": true,
            "colors": [
                                        "#88E0B0",
                                        "#FF5771",
                                        "#FFCF00",
                                        "#5FABBB"
                                    ],
            "titles": [
                                        {
                                            "id": "judul",
                                            "size": 15,
                                            "text": "Berdasarkan Jenis Temuan"
                                        }
                                    ],
            "percentPrecision": 0,
            "thousandsSeparator": ".",
            "dataProvider": data2,
            "valueField": "Jumlah",
            "titleField": "Jenis Temuan",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[title]]</b> ([[percents]]%)</span>",
            "angle": 5,
            "labelsEnabled": false
        }
    );
</script>

<!-- amCharts javascript code-->
<script type="text/javascript">
    var data3 = JSON.parse("{{$result3}}".replace(/&quot;/g,'"'));
    //console.log(data3);
    AmCharts.makeChart("piegraphs3",
        {
            "type": "pie",
            "theme": "none",
            "adjustPrecision": true,
            "colors": [
                                        "#88E0B0",
                                        "#FF5771",
                                        "#FFCF00",
                                        "#5FABBB"
                                    ],
            "titles": [
                                        {
                                            "id": "judul",
                                            "size": 15,
                                            "text": "Berdasarkan Jenis Sebab"
                                        }
                                    ],
            "percentPrecision": 0,
            "thousandsSeparator": ".",
            "dataProvider": data3,
            "valueField": "Jumlah",
            "titleField": "Jenis Sebab",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[title]]</b> ([[percents]]%)</span>",
            "angle": 5,
            "labelsEnabled": false
        }
    );
</script>

<!-- amCharts javascript code-->
<script type="text/javascript">
    var data4 = JSON.parse("{{$result4}}".replace(/&quot;/g,'"'));
    //console.log(data4);
    AmCharts.makeChart("piegraphs4",
        {
            "type": "pie",
            "theme": "none",
            "adjustPrecision": true,
            "colors": [
                                        "#88E0B0",
                                        "#FF5771",
                                        "#FFCF00",
                                        "#5FABBB"
                                    ],
            "titles": [
                                        {
                                            "id": "judul",
                                            "size": 15,
                                            "text": "Berdasarkan Jenis Rekomendasi"
                                        }
                                    ],
            "percentPrecision": 0,
            "thousandsSeparator": ".",
            "dataProvider": data4,
            "valueField": "Jumlah",
            "titleField": "Jenis Rekomendasi",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[title]]</b> ([[percents]]%)</span>",
            "angle": 5,
            "labelsEnabled": false
        }
    );
</script>

<!-- amCharts javascript code-->
<script type="text/javascript">
    var data5 = JSON.parse("{{$result5}}".replace(/&quot;/g,'"'));
    //console.log(data5);
    AmCharts.makeChart("piegraphs5",
        {
            "type": "pie",
            "theme": "none",
            "adjustPrecision": true,
            "colors": [
                                        "#88E0B0",
                                        "#FF5771",
                                        "#FFCF00",
                                        "#5FABBB"
                                    ],
            "titles": [
                                        {
                                            "id": "judul",
                                            "size": 15,
                                            "text": "Berdasarkan Jenis Tindak Lanjut"
                                        }
                                    ],
            "percentPrecision": 0,
            "thousandsSeparator": ".",
            "dataProvider": data5,
            "valueField": "Jumlah",
            "titleField": "Jenis Tindak Lanjut",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[title]]</b> ([[percents]]%)</span>",
            "angle": 5,
            "labelsEnabled": false
        }
    );
</script>

<!-- amCharts javascript code-->
<script type="text/javascript">
    var batang1 = JSON.parse("{{$batang1}}".replace(/&quot;/g,'"'));
    console.log(batang1);
    AmCharts.makeChart("batang1",
        {
            "type": "serial",
            "theme": "none",
            "startDuration": 2,
            "titles": [
                                        {
                                            "id": "judul",
                                            "size": 14,
                                            "text": "Nilai Temuan Berdasarkan Kodifikasi Temuan"
                                        }
                                    ],
            "percentPrecision": 0,
            "thousandsSeparator": ".",
            "dataProvider": batang1,
            "valueAxes": [{
                            "position": "left",
                            "title": "Nilai Uang (Dalam IDR)"
                        }],
                        "graphs": [{
                                        "balloonText": "[[category]] <br /><b>[[value]]</b>",
                                        "fillAlphas": 1,
                                        "lineAlpha": 0.1,
                                        "type": "column",
                                        "valueField": "NilaiUang"
                                    }],
                        "depth3D": 20,
                        "angle": 30,
                        "chartCursor": {
                                        "categoryBalloonEnabled": false,
                                        "cursorAlpha": 0,
                                        "zoomable": false
                                    },
                        "categoryField": "Kodifikasi Temuan",
                        "categoryAxis": {
                                        "gridPosition": "start",
                                        "labelRotation": 90,
                                        "labelsEnabled": false
                                    }
        }
    );
</script>
<div class="row">
    <div class="col-sm-12"><center><h2>GRAFIK LAPORAN HASIL PENGAWASAN</h2></center></div>
</div>
<div class="row">
    <div id="piegraphs1" style="height:400px; background-color: #FFFFFF;" class="col-sm-4"></div>
    <div id="piegraphs2" style="height:400px; background-color: #FFFFFF;" class="col-sm-4"></div>
    <div id="piegraphs3" style="height:400px; background-color: #FFFFFF;" class="col-sm-4"></div>
</div>
<div class="row">
        <div class="col-sm-2"></div>
        <div id="piegraphs4" style="height:400px; background-color: #FFFFFF;" class="col-sm-4"></div>
        <div id="piegraphs5" style="height:400px; background-color: #FFFFFF;" class="col-sm-4"></div>
        <div class="col-sm-2"></div>
    </div>
<div class="row">
    <div id="batang1" style="height:400px; background-color: #FFFFFF;" class="col-sm-6"></div>
    <div class="col-sm-6"></div>
</div>

                {{-- <div id="piegraphs4" class="col-md-6"></div> --}}



@endsection
