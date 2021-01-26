
@extends('crudbooster::admin_template')
@push('head')

@endpush
@section('content')
<script src="/vendor/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="/vendor/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="/vendor/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="/scripts/lodash.min.js" type="text/javascript"></script>

<!-- amCharts javascript code-->
<script type="text/javascript">
    var dataInputer = JSON.parse("{{$resultInputer}}".replace(/&quot;/g,'"'));
    
    AmCharts.makeChart("piegraphInputer",
        {
            "type": "pie",
            "theme": "light",
            "adjustPrecision": true,
            "colors": [
                                        "#67D0DD",
                                        "#9FE481",
                                        "#F6E785",
                                        "#FAAFA5",
                                        "#DC95DD",
                                        "#A885EE"
                                    ],
            "titles": [
                                        {
                                            "id": "judul",
                                            "size": 15,
                                            "text": "Berdasarkan Inputer"
                                        }
                                    ],
            "percentPrecision": 0,
            "thousandsSeparator": ".",
            "dataProvider": dataInputer,
            "valueField": "Jumlah",
            "titleField": "Nama",
            "urlField": "url",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 5,
            "labelsEnabled": true,
            "labelText": "([[percents]]%)",
            "labelRadius": -35,
            "innerRadius": "0%",
            "legend": {
                "enabled": true,
                "align": "center",
                "labelText": "[[title]]:",
                "reversedOrder": true,
                "maxColumns": 1,
                "valueAlign": "left",
                "verticalGap": 0
                }
        }
    );
</script>
<!-- amCharts javascript code-->
    <script type="text/javascript">
        var data1 = JSON.parse("{{$result1}}".replace(/&quot;/g,'"'));
        //console.log(data1);
        AmCharts.makeChart("piegraphs1",
            {
                "type": "pie",
                "theme": "light",
                "adjustPrecision": true,
                "colors": [
                                            "#67D0DD",
                                            "#9FE481",
                                            "#F6E785",
                                            "#FAAFA5",
                                            "#DC95DD",
                                            "#A885EE"
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
                "urlField": "url",
                "outlineAlpha": 0.4,
                "depth3D": 15,
                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                "angle": 5,
                "labelsEnabled": true,
                "labelText": "([[percents]]%)",
                "labelRadius": -35,
                "innerRadius": "0%",
                "legend": {
                    "enabled": true,
                    "align": "center",
                    "labelText": "[[title]]:",
                    "reversedOrder": true,
                    "maxColumns": 1,
                    "valueAlign": "left",
                    "verticalGap": 0
                    }
            }
        );
    </script>

<!-- amCharts javascript code-->
<script type="text/javascript">
    var data2 = JSON.parse("{{$result2}}".replace(/&quot;/g,'"'));
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
    //console.log(data2);
    var chart = AmCharts.makeChart("piegraphs2",
        {
            "type": "pie",
            "theme": "light",
            "adjustPrecision": true,
            "colors": [
                                            "#67D0DD",
                                            "#9FE481",
                                            "#F6E785",
                                            "#FAAFA5",
                                            "#DC95DD",
                                            "#A885EE"
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
            "urlField": "url",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 5,
            "labelsEnabled": true,
            "labelText": "([[percents]]%)",
            "labelRadius": -35,
                "innerRadius": "0%",
                "legend": {
                    "enabled": true,
                    "align": "center",
                    "labelText": "[[title]]:",
                    "truncateLabels": 20,
                    "reversedOrder": true,
                    "maxColumns": 2,
                    "valueAlign": "left",
                    "verticalGap": 0
                    }
        }
    );

</script>

<!-- amCharts javascript code-->
<script type="text/javascript">
    var data3 = JSON.parse("{{$result3}}".replace(/&quot;/g,'"'));
    //console.log(data3);

     chart = AmCharts.makeChart("piegraphs3",
        {
            "type": "pie",
            "theme": "light",
            "adjustPrecision": true,
             "colors": [
                                            "#67D0DD",
                                            "#9FE481",
                                            "#F6E785",
                                            "#FAAFA5",
                                            "#DC95DD",
                                            "#A885EE"
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
            "urlField": "url",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 5,
            "labelsEnabled": true,
            "labelText": "([[percents]]%)",
            "labelRadius": -35,
                "innerRadius": "0%",
                "legend": {
                    "enabled": true,
                    "align": "center",
                    "labelText": "[[title]]:",

                    "reversedOrder": true,
                    "maxColumns": 2,
                    "valueAlign": "left",
                    "verticalGap": 0
                    }
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
            "theme": "light",
            "adjustPrecision": true,
            "colors": [
                                            "#67D0DD",
                                            "#9FE481",
                                            "#F6E785",
                                            "#FAAFA5",
                                            "#DC95DD",
                                            "#A885EE",
                                            "#ACECD5",
                                            "#FFF9AA",
                                            "#FFD5B8",
                                            "#FFB9B3",
                                            "#C5EBFE",
                                            "#FEFD97",
                                            "#A5F8CE",
                                            "#FEC9A7"
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
            "urlField": "url",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 5,
            "labelsEnabled": true,
            "labelText": "([[percents]]%)",
            "labelRadius": -35,
                "innerRadius": "0%",
                "legend": {
                    "enabled": true,
                    "align": "center",
                    "labelText": "[[title]]:",
                    "truncateLabels": 15,
                    "reversedOrder": true,
                    "maxColumns": 2,
                    "valueAlign": "left",
                    "position": "bottom",
                    "verticalGap": 0
                    }
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
            "theme": "light",
            "adjustPrecision": true,
            "colors": [
                                            "#67D0DD",
                                            "#9FE481",
                                            "#F6E785",
                                            "#FAAFA5",
                                            "#DC95DD",
                                            "#A885EE"
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
            "urlField": "url",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 5,
            "labelsEnabled": true,
            "labelText": "([[percents]]%)",
            "labelRadius": -35,
                "innerRadius": "0%",
                "legend": {
                    "enabled": true,
                    "align": "center",
                    "labelText": "[[title]]:",
                    "truncateLabels": 15,
                    "reversedOrder": true,
                    "maxColumns": 1,
                    "valueAlign": "left",
                    "position": "bottom",
                    "verticalGap": 0
                    }
        }
    );
</script>

<!-- amCharts javascript code-->
<script type="text/javascript">
    var batang1 = JSON.parse("{{$batang1}}".replace(/&quot;/g,'"'));
    var grouped = _.mapValues(_.groupBy(batang1, 'kode'),
                          clist => clist.map(batang1 => _.omit(batang1, 'kode')));

    //console.log(grouped);
    for(var k in grouped) {

        //console.log(grouped[k]);
        }

AmCharts.addInitHandler(function(chart) {

  // check if there are graphs with autoColor: true set
  for(var i = 0; i < chart.graphs.length; i++) {
    var graph = chart.graphs[i];
    if (graph.autoColor !== true)
      continue;
    var colorKey = "color";
    graph.lineColorField = colorKey;
    graph.fillColorsField = colorKey;
    graph.colorField = colorKey;
    for(var x = 0; x < chart.dataProvider.length; x++) {
      var color = chart.colors[x]
      chart.dataProvider[x][colorKey] = color;
    }
  }

  function numberWithCommas(x) {
    if(x != null){
        return x.toLocaleString('id-ID');
    }else{
        return null;
    }
    
}

  function handleCustomMarkerToggle(legendEvent) {
      var dataProvider = legendEvent.chart.dataProvider;
      var itemIndex; //store the location of the removed item

      //Set a custom flag so that the dataUpdated event doesn't fire infinitely, in case you have
      //a dataUpdated event of your own
      legendEvent.chart.toggleLegend = true;
      // The following toggles the markers on and off.
      // The only way to "hide" a column and reserved space on the axis is to remove it
      // completely from the dataProvider. You'll want to use the hidden flag as a means
      // to store/retrieve the object as needed and then sort it back to its original location
      // on the chart using the dataIdx property in the init handler
      if (undefined !== legendEvent.dataItem.hidden && legendEvent.dataItem.hidden) {
        legendEvent.dataItem.hidden = false;
        dataProvider.push(legendEvent.dataItem.storedObj);
        legendEvent.dataItem.storedObj = undefined;
        //re-sort the array by dataIdx so it comes back in the right order.
        dataProvider.sort(function(lhs, rhs) {
          return lhs.dataIdx - rhs.dataIdx;
        });
      } else {
        // toggle the marker off
        legendEvent.dataItem.hidden = true;
        //get the index of the data item from the data provider, using the
        //dataIdx property.
        for (var i = 0; i < dataProvider.length; ++i) {
          if (dataProvider[i].dataIdx === legendEvent.dataItem.dataIdx) {
            itemIndex = i;
            break;
          }
        }
        //store the object into the dataItem
        legendEvent.dataItem.storedObj = dataProvider[itemIndex];
        //remove it
        dataProvider.splice(itemIndex, 1);
      }
      legendEvent.chart.validateData(); //redraw the chart
  }

  //check if legend is enabled and custom generateFromData property
  //is set before running
  if (!chart.legend || !chart.legend.enabled || !chart.legend.generateFromData) {
    return;
  }

  var categoryField = chart.categoryField;
  var colorField = chart.graphs[0].lineColorField || chart.graphs[0].fillColorsField || chart.graphs[0].colorField;
  var legendData =  chart.dataProvider.map(function(data, idx) {
    var markerData = {
      "title": data[categoryField] + ": " + numberWithCommas(data[chart.graphs[0].valueField]),
      "color": data[colorField],
      "dataIdx": idx //store a copy of the index of where this appears in the dataProvider array for ease of removal/re-insertion
    };
    if (!markerData.color) {
      markerData.color = chart.graphs[0].lineColor;
    }
    data.dataIdx = idx; //also store it in the dataProvider object itself
    return markerData;
  });

  chart.legend.data = legendData;

  //make the markers toggleable
  chart.legend.switchable = true;
  chart.legend.addListener("clickMarker", handleCustomMarkerToggle);

}, ["serial"]);
    for(var k in grouped) {
    var chart = AmCharts.makeChart("batang1"+k,
        {
            "type": "serial",
            "theme": "light",
            "colors": [
                                            "#67D0DD",
                                            "#9FE481",
                                            "#F6E785",
                                            "#FAAFA5",
                                            "#DC95DD",
                                            "#A885EE",
                                            "#ACECD5",
                                            "#FFF9AA",
                                            "#FFD5B8",
                                            "#FFB9B3",
                                            "#C5EBFE",
                                            "#FEFD97",
                                            "#A5F8CE",
                                            "#FEC9A7"
                                        ],
            "startDuration": 2,
            "titles": [
                                        {
                                            "id": "judul",
                                            "size": 14,
                                            "text": ""
                                        }
                                    ],
            "precision":2,
            "percentPrecision": 0,
            "thousandsSeparator": ".",
            "decimalSeparator":",",
            "dataProvider": grouped[k],
            "valueAxes": [{
                            "position": "left",
                            "title": "Nilai Uang dalam ("+k+")"
                        }],
            "graphs": [{
                                        "balloonText": "[[category]] <br /><b>"+k+" [[value]]</b>",
                                        "autoColor": true,
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
                        "categoryField": "KodTemuan",
                        "categoryAxis": {
                                        "gridPosition": "start",
                                        "labelRotation": 90,
                                        "labelsEnabled": false
                                    },
                        "legend": {
                                        "generateFromData": true
                                    }
        }
    );
    }
</script>
<script type="text/javascript">
    var batang2 = JSON.parse("{{$batang2}}".replace(/&quot;/g,'"'));
    //console.log(batang2);
    var grouped2 = _.mapValues(_.groupBy(batang2, 'kode'),
                          clist => clist.map(batang2 => _.omit(batang2, 'kode')));
    for(var k in grouped2) {
    var chart = AmCharts.makeChart("batang2"+k,
        {
            "type": "serial",
            "theme": "light",
            "colors": [
                                            "#67D0DD",
                                            "#9FE481",
                                            "#F6E785",
                                            "#FAAFA5",
                                            "#DC95DD",
                                            "#A885EE"
                                        ],
            "startDuration": 2,
            "titles": [
                                        {
                                            "id": "judul",
                                            "size": 14,
                                            "text": ""
                                        }
                                    ],
            "precision":2,
            "percentPrecision": 0,
            "thousandsSeparator": ".",
            "decimalSeparator":",",
            "dataProvider": grouped2[k],
            "valueAxes": [{
                            "position": "left",
                            "title": "Nilai Uang dalam ("+k+")"
                        }],
            "graphs": [{
                                        "balloonText": "[[category]] <br /><b>"+k+" [[value]]</b>",
                                        "autoColor": true,
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
                        "categoryField": "statusTL",
                        "categoryAxis": {
                                        "gridPosition": "start",
                                        "labelRotation": 90,
                                        "labelsEnabled": false
                                    },
                        "legend": {
                                        "generateFromData": true
                                    }
        }
    );
    }
</script>
<div class="row">
<div class="col-sm-12"><center><h2>STATISTIK LAPORAN HASIL PENGAWASAN<br/><small>{{$unit}}<br/>
</small></h2>
</center></div>
</div>
<div class="row">
    <div class="col-sm-12"><center>
    <form class="form-inline" action="{{ URL::to('/ma/d_j_awas/') }}">
        {{ csrf_field() }}
        <div class="input-group">
            <div class="input-group-addon">Tahun</div>
            <select class="form-control" id="tahun" name="tahun">
                <option value="">All</option>
                @foreach($tahunSelector->unique('tahun')->sortBy('tahun') as $row)
                    @if($row->tahun == $input['tahun'])
                    <option value="{{$row->tahun}}" selected="selected">{{$row->tahun}}</option>
                    @else
                    <option value="{{$row->tahun}}">{{$row->tahun}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="input-group">
            <div class="input-group-addon">Status Kirim</div>
            <select class="form-control" id="statusKirim" name="statusKirim">
                <option value="">All</option>
                @foreach($statusSelector->unique('status')->sortBy('status') as $row)
                    @if($row->id_status_kirim == $input['statusKirim'])
                    <option value="{{$row->id_status_kirim}}" selected="selected">{{$row->status}}</option>
                    @else
                    <option value="{{$row->id_status_kirim}}">{{$row->status}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-default">Tampilkan</button>
    </form>
    </center>
    </div>
</div>
@if($resultInputer)
<div class="row">
    <div id="piegraphInputer" style="height:500px; background-color: #FFFFFF;" class="col-md-12"></div>
</div>
@endif
<div class="row">
    <div id="piegraphs1" style="height:500px; background-color: #FFFFFF;" class="col-md-6"></div>
    <div id="piegraphs2" style="height:500px; background-color: #FFFFFF;" class="col-md-6"></div>
</div>
<h3>&nbsp;</h3>
<div class="row">
        <div id="piegraphs3" style="max-height:500px; background-color: #FFFFFF;" class="col-md-6"></div>
        <div id="piegraphs4" style="max-height:500px; background-color: #FFFFFF;" class="col-md-6"></div>
    </div>
    <h3>&nbsp;</h3>
    <div class="row">
        <div id="piegraphs5" style="height:500px; background-color: #FFFFFF;" class="col-md-12"></div>
    </div>
@if($matauang)
<div class="row"><h3>Nilai Temuan Berdasarkan Kodefikasi Temuan</h3>
@foreach ($matauang as $uang)
@if($uang)
<div class="row">
    <div id="batang1{{$uang->kode}}" style="min-height:800px; background-color: #FFFFFF;" class="col-sm-12"></div>
</div>
@endif
@endforeach
</div>
@endif
@if($matauang)
<div class="row"><h3>Nilai Temuan Berdasarkan Status Tindak Lanjut</h3>
@foreach ($matauang as $uang)
@if($uang)
<div class="row">
    <div id="batang2{{$uang->kode}}" style="min-height:800px; background-color: #FFFFFF;" class="col-sm-12"></div>
</div>
@endif
@endforeach
</div>
@endif

                {{-- <div id="piegraphs4" class="col-md-6"></div> --}}



@endsection
