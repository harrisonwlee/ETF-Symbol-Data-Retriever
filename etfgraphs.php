<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>amCharts examples</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="amcharts/amcharts.js" type="text/javascript"></script>
        <script src="amcharts/serial.js" type="text/javascript"></script>

		<script type = "text/javascript">
			var chartData = [{
				"Company": $companies[0],
				"Shares Held": $shares_held[0]
			}, {
				"Company": $companies[1],
				"Shares Held": $shares_held[1]
			}, {
				"Company": $companies[2],
				"Shares Held": $shares_held[2]
			}, {
				"Company": $companies[3],
				"Shares Held": $shares_held[3]
			}, {
				"Company": $companies[4],
				"Shares Held": $shares_held[4]
			}, {
				"Company": $companies[5],
				"Shares Held": $shares_held[5]
			}, {
				"Company": $companies[6],
				"Shares Held": $shares_held[6]
			}, {
				"Company": $companies[7],
				"Shares Held": $shares_held[7]
			}, {
				"Company": $companies[8],
				"Shares Held": $shares_held[8]
			}, {
				"Company": $companies[9],
				"Shares Held": $shares_held[9]
			}];
			
			AmCharts.ready(function() {
				var chart = new AmCharts.AmSerialChart();
				chart.dataProvider = chartData;
				chart.categoryField = "Company";
				var graph = new AmCharts.AmGraph();
				graph.valueField = "Shares Held";
				graph.type = "column";
				chart.addGraph(graph);
				
				chart.write('chartdiv');
			});
		</script>
    </head>

    <body>
        <div id="chartdiv" style="width: 100%; height: 400px;"></div>
    </body>

</html>