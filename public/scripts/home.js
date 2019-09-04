            var chart;
            /*var chartData = [
                {
                    "country": "2009",
                    "year2004": 3.5,
                    "year2005": 4.2
                },{
                    "country": "2010",
                    "year2004": 1.7,
                    "year2005": 3.1
                },{
                    "country": "2011",
                    "year2004": 2.8,
                    "year2005": 2.9
                },{
                    "country": "2012",
                    "year2004": 2.6,
                    "year2005": 2.3
                },{
                    "country": "2013",
                    "year2004": 1.4,
                    "year2005": 2.1
                },{
                    "country": "2014",
                    "year2004": 2.6,
                    "year2005": 4.9
                },{
                    "country": "2015",
                    "year2004": 6.4,
                    "year2005": 7.2
                },{
                    "country": "APBN 2016",
                    "year2004": 8,
                    "year2005": 7.1
                },{
                    "country": "APBN 2017",
                    "year2004": 10.9,
                    "year2005": 12.1
                }
            ]; */
            /*AmCharts.ready(function () {
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "country";
                chart.color = "#222222";
                chart.fontSize = 14;
                chart.startDuration = 1;
                chart.plotAreaFillAlphas = 0.2;
                chart.angle = 30;
                chart.depth3D = 60;

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
                valueAxis.title = "GDP growth rate";
                valueAxis.titleColor = "#222222";
                valueAxis.unit = "%";
                chart.addValueAxis(valueAxis);

                var graph1 = new AmCharts.AmGraph();
                graph1.title = "2004";
                graph1.valueField = "year2004";
                graph1.type = "column";
                graph1.lineAlpha = 0;
                graph1.lineColor = "#194C85";
                graph1.fillAlphas = 1;
                graph1.balloonText = "GDP grow in [[category]] (2004): <b>[[value]]</b>";
                chart.addGraph(graph1);

                var graph2 = new AmCharts.AmGraph();
                graph2.title = "2005";
                graph2.valueField = "year2005";
                graph2.type = "column";
                graph2.lineAlpha = 0;
                graph2.lineColor = "#FFCB05";
                graph2.fillAlphas = 1;
                graph2.balloonText = "GDP grow in [[category]] (2005): <b>[[value]]</b>";
                chart.addGraph(graph2);

                chart.write("graphs1");
            }); */
			
            var chartDatas = [
                {
                    "year": 2005,
                    "income": 23.5,
                    "expenses": 18.1
                },{
                    "year": 2006,
                    "income": 26.2,
                    "expenses": 22.8
                },{
                    "year": 2007,
                    "income": 30.1,
                    "expenses": 23.9
                },{
                    "year": 2008,
                    "income": 29.5,
                    "expenses": 25.1
                },{
                    "year": 2009,
                    "income": 24.6,
                    "expenses": 25
                }
            ];


            /*AmCharts.ready(function () {
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartDatas;
                chart.categoryField = "year";
                chart.startDuration = 1;
                chart.plotAreaBorderColor = "#DADADA";
                chart.plotAreaBorderAlpha = 1;
                chart.rotate = true; 
                chart.angle = 15;
                chart.depth3D = 5;

                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.axisAlpha = 0;

                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisAlpha = 0;
                valueAxis.gridAlpha = 0.1;
                valueAxis.position = "top";
                chart.addValueAxis(valueAxis);

                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "Income";
                graph1.valueField = "income";
                graph1.balloonText = "Income:[[value]]";
                graph1.lineAlpha = 0;
                graph1.fillColors = "#0250A3";
                graph1.fillAlphas = 1;
                chart.addGraph(graph1);

                var graph2 = new AmCharts.AmGraph();
                graph2.type = "column";
                graph2.title = "Expenses";
                graph2.valueField = "expenses";
                graph2.balloonText = "Expenses:[[value]]";
                graph2.lineAlpha = 0;
                graph2.fillColors = "#FFCB05";
                graph2.fillAlphas = 1;
                chart.addGraph(graph2);

                var legend = new AmCharts.AmLegend();
                chart.addLegend(legend);

                chart.creditsPosition = "top-right";

                chart.write("graphs2");
            });

			var chartData3 = [
                {
                    "year": 2009,
                    "income": 23.5,
                    "expenses": 18.1
                },{
                    "year": 2010,
                    "income": 26.2,
                    "expenses": 22.8
                },{
                    "year": 2011,
                    "income": 30.1,
                    "expenses": 33.9
                },{
                    "year": 2012,
                    "income": 29.5,
                    "expenses": 30.1
                },{
                    "year": 2013,
                    "income": 30.6,
                    "expenses": 27.2,
                    "dashLengthLine": 5
                },{
                    "year": 2014,
                    "income": 34.1,
                    "expenses": 29.9,
                    "dashLengthColumn": 5,
                    "alpha":0.2,
                    "additional":"(projection)"
                }
            ];
            AmCharts.ready(function () {
                chart = new AmCharts.AmSerialChart();

                chart.dataProvider = chartData3;
                chart.categoryField = "year";
                chart.startDuration = 1;

                chart.handDrawn = true;
                chart.handDrawnScatter = 3;
                chart.angle = 25;
                chart.depth3D = 20;

                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";

                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisAlpha = 0;
                chart.addValueAxis(valueAxis);

                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "Income";
                graph1.lineColor = "#0250A3";
                graph1.valueField = "income";
                graph1.lineAlpha = 1;
                graph1.fillAlphas = 1;
                graph1.dashLengthField = "dashLengthColumn";
                graph1.alphaField = "alpha";
                graph1.balloonText = "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span>";
                chart.addGraph(graph1);

                var graph2 = new AmCharts.AmGraph();
                graph2.type = "line";
                graph2.title = "Expenses";
                graph2.lineColor = "#58A500";
                graph2.valueField = "expenses";
                graph2.lineThickness = 3;
                graph2.bullet = "round";
                graph2.bulletBorderThickness = 3;
                graph2.bulletBorderColor = "#fcd202";
                graph2.bulletBorderAlpha = 1;
                graph2.bulletColor = "#ffffff";
                graph2.dashLengthField = "dashLengthLine";
                graph2.balloonText = "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span>";
                chart.addGraph(graph2);

                var legend = new AmCharts.AmLegend();
                legend.useGraphSettings = true;
                chart.addLegend(legend);

                chart.write("graphs3");
            });*/
			
		/*	var chartData4 = [
                {
                    "date": "2012-01-01",
                    "distance": 227,
                    "townName": "New York",
                    "townName2": "New York",
                    "townSize": 25,
                    "latitude": 40.71,
                    "duration": 408
                },{
                    "date": "2012-01-02",
                    "distance": 371,
                    "townName": "Washington",
                    "townSize": 14,
                    "latitude": 38.89,
                    "duration": 482
                },{
                    "date": "2012-01-03",
                    "distance": 433,
                    "townName": "Wilmington",
                    "townSize": 6,
                    "latitude": 34.22,
                    "duration": 562
                },{
                    "date": "2012-01-04",
                    "distance": 345,
                    "townName": "Jacksonville",
                    "townSize": 7,
                    "latitude": 30.35,
                    "duration": 379
                },{
                    "date": "2012-01-05",
                    "distance": 480,
                    "townName": "Miami",
                    "townName2": "Miami",
                    "townSize": 10,
                    "latitude": 25.83,
                    "duration": 501
                },{
                    "date": "2012-01-06",
                    "distance": 386,
                    "townName": "Tallahassee",
                    "townSize": 7,
                    "latitude": 30.46,
                    "duration": 443
                },{
                    "date": "2012-01-07",
                    "distance": 348,
                    "townName": "New Orleans",
                    "townSize": 10,
                    "latitude": 29.94,
                    "duration": 405
                },{
                    "date": "2012-01-08",
                    "distance": 238,
                    "townName": "Houston",
                    "townName2": "Houston",
                    "townSize": 16,
                    "latitude": 29.76,
                    "duration": 309
                },{
                    "date": "2012-01-09",
                    "distance": 218,
                    "townName": "Dalas",
                    "townSize": 17,
                    "latitude": 32.8,
                    "duration": 287
                },{
                    "date": "2012-01-10",
                    "distance": 349,
                    "townName": "Oklahoma City",
                    "townSize": 11,
                    "latitude": 35.49,
                    "duration": 485
                },{
                    "date": "2012-01-11",
                    "distance": 603,
                    "townName": "Kansas City",
                    "townSize": 10,
                    "latitude": 39.1,
                    "duration": 890
                },{
                    "date": "2012-01-12",
                    "distance": 534,
                    "townName": "Denver",
                    "townName2": "Denver",
                    "townSize": 18,
                    "latitude": 39.74,
                    "duration": 810
                },{
                    "date": "2012-01-13",
                    "townName": "Salt Lake City",
                    "townSize": 12,
                    "distance": 425,
                    "duration": 670,
                    "latitude": 40.75,
                    "dashLength": 8,
                    "alpha":0.4
                },{
                    "date": "2012-01-14",
                    "latitude": 36.1,
                    "duration": 470,
                    "townName": "Las Vegas",
                    "townName2": "Las Vegas"
                },{
                    "date": "2012-01-15"
                },{
                    "date": "2012-01-16"
                },{
                    "date": "2012-01-17"
                },{
                    "date": "2012-01-18"
                },{
                    "date": "2012-01-19"
                }
            ];
            var chart;

            AmCharts.ready(function () {
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData4;
                chart.categoryField = "date";
                chart.dataDateFormat = "YYYY-MM-DD";
                chart.color = "#111111";
                chart.marginLeft = 0;
                chart.angle = 10;
                chart.depth3D = 8;

                var categoryAxis = chart.categoryAxis;
                categoryAxis.parseDates = true;
				categoryAxis.minPeriod = "DD";
				categoryAxis.autoGridCount = false;
                categoryAxis.gridCount = 50;
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.gridColor = "#222222";
                categoryAxis.axisColor = "#555555";
                categoryAxis.dateFormats = [{
                    period: 'DD',
                    format: 'DD'
                }, {
                    period: 'WW',
                    format: 'MMM DD'
                }, {
                    period: 'MM',
                    format: 'MMM'
                }, {
                    period: 'YYYY',
                    format: 'YYYY'
                }];

                var distanceAxis = new AmCharts.ValueAxis();
                distanceAxis.title = "distance";
                distanceAxis.gridAlpha = 0;
                distanceAxis.axisAlpha = 0;
                chart.addValueAxis(distanceAxis);

                var latitudeAxis = new AmCharts.ValueAxis();
                latitudeAxis.gridAlpha = 0;
                latitudeAxis.axisAlpha = 0;
                latitudeAxis.labelsEnabled = false;
                latitudeAxis.position = "right";
                chart.addValueAxis(latitudeAxis);

                var durationAxis = new AmCharts.ValueAxis();
                durationAxis.title = "duration";
                durationAxis.duration = "mm";
                durationAxis.durationUnits = {
                    DD: "d. ",
                    hh: "h ",
                    mm: "min",
                    ss: ""
                };
                durationAxis.gridAlpha = 0;
                durationAxis.axisAlpha = 0;
                durationAxis.inside = true;
                durationAxis.position = "right";
                chart.addValueAxis(durationAxis);

                var distanceGraph = new AmCharts.AmGraph();
                distanceGraph.valueField = "distance";
                distanceGraph.title = "distance";
                distanceGraph.type = "column";
                distanceGraph.fillAlphas = 0.9;
                distanceGraph.valueAxis = distanceAxis;
				distanceGraph.balloonText = "[[value]] miles";
                distanceGraph.legendValueText = "[[value]] mi";
                distanceGraph.legendPeriodValueText = "total: [[value.sum]] mi";
                distanceGraph.lineColor = "#0250A3";
                distanceGraph.dashLengthField = "dashLength";
                distanceGraph.alphaField = "alpha";
                chart.addGraph(distanceGraph);

                var latitudeGraph = new AmCharts.AmGraph();
                latitudeGraph.valueField = "latitude";
                latitudeGraph.title = "latitude/city";
                latitudeGraph.type = "line";
                latitudeGraph.valueAxis = latitudeAxis;
				latitudeGraph.lineColor = "#85B760";
                latitudeGraph.lineThickness = 3;
                latitudeGraph.legendValueText = "[[description]]/[[value]]";
                latitudeGraph.descriptionField = "townName";
                latitudeGraph.bullet = "round";
                latitudeGraph.bulletSizeField = "townSize";
				latitudeGraph.bulletBorderColor = "#57763E";
                latitudeGraph.bulletBorderAlpha = 1;
                latitudeGraph.bulletBorderThickness = 2;
                latitudeGraph.bulletColor = "#007F00";
                latitudeGraph.labelText = "[[townName2]]";
				latitudeGraph.labelPosition = "right";
                latitudeGraph.balloonText = "latitude:[[value]]";
                latitudeGraph.showBalloon = true;
                latitudeGraph.dashLengthField = "dashLength";
                chart.addGraph(latitudeGraph);

                // duration graph
                var durationGraph = new AmCharts.AmGraph();
                durationGraph.title = "duration";
                durationGraph.valueField = "duration";
                durationGraph.type = "line";
                durationGraph.valueAxis = durationAxis;
				durationGraph.lineColor = "#FDD400";
                durationGraph.balloonText = "[[value]]";
                durationGraph.lineThickness = 2;
                durationGraph.legendValueText = "[[value]]";
                durationGraph.bullet = "square";
                durationGraph.bulletBorderColor = "#FDD400";
                durationGraph.bulletBorderThickness = 1;
                durationGraph.bulletBorderAlpha = 1;
                durationGraph.dashLengthField = "dashLength";
                chart.addGraph(durationGraph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonDateFormat = "DD";
                chartCursor.cursorAlpha = 0;
                chartCursor.valueBalloonsEnabled = false;
                chart.addChartCursor(chartCursor);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                legend.bulletType = "round";
                legend.equalWidths = false;
                legend.valueWidth = 120;
                legend.useGraphSettings = true;
                legend.color = "#111111";
                chart.addLegend(legend);

                // WRITE
                chart.write("graphs4");
            }); */
			function load_graph(nomor,data){
				$("html, body").animate({scrollTop: 1080}, 1000);
				$('.graph_thumb .item').removeClass('actives');
				$('.th_'+nomor).addClass('actives');
				$('.gr').removeClass('active');
				$('.gra').removeClass('active');
				$('#graphs'+data).addClass('active');
				$('#graphshead'+data).addClass('active');
				$('#graphslink'+data).addClass('active');
			}
			function load_info(data){
				$('a.tab').removeClass('active');
				$('a.tb_'+data).addClass('active');
				$('.ct').addClass('nonactive');
				$('#ct_'+data).removeClass('nonactive');
				$("html, body").animate({scrollTop:2250}, 1000);
				$.post("info_"+data+".html" ,{
				}, function(response){
					$('.tab-content').html(unescape(response));
				});
			}
			$(function(){
			    
			    $(window).resize(function(){
 
 
});
			    
				$('.input-search').focus(function(){
					$(this).parent().addClass('expanded');
				});
				$('.input-search').blur(function(){
				    
					//$(this).parent().removeClass('expanded');
				});
				
				$("#txt_search").on("click",function() {
					$('.bg_search').fadeIn();
					$('.social-fixed').addClass('none');
				});
				$(".submit-search").on("click",function() {
					$('#searchforms').submit();
				});
				$("#txt_search").on("focusout",function() {
					$('.bg_search').fadeOut();
					//$('#searchbart').removeClass('expanded');
					$('.social-fixed').removeClass('none');
				});
				$(".bg_search, .text-search").on("click",function() {
					$('.bg_search').fadeOut();
					$('#searchbart').removeClass('expanded');
					$('.social-fixed').removeClass('none');
				});
				$('.graph_thumb').owlCarousel({
					items: 4,
					animateOut: 'fadeOut',
					loop: true,
					navText:["",""],
					nav: true,
					dots:false,
					margin: 10,
				});
				$('.fadeOut').owlCarousel({
					items: 1,
					animateOut: 'fadeOut',
					autoplay: 'true',
					autoplayTimeout:5000,
                    autoplayHoverPause:true,
					loop: true,
					margin: 10,
				});
				$('.own-peraturan').owlCarousel({
					nav: false,
					dots: true,
					items: 1,
					animateOut: 'fadeOut',
					loop: true,
					margin: 10,
				});
				$('.data-eselon').owlCarousel({
					nav: false,
					dots: true,
					items: 4,
					animateOut: 'fadeOut',
					loop: true,
					margin: 20,
				});
			});
