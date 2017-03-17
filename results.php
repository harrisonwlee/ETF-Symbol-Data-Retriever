<html>
	<head>
		<title> 
			ETF Data
		</title>
		<link rel = "stylesheet" type = "text/css" href = "style-resultpage.css">
		<script src="amcharts/amcharts.js" type="text/javascript"></script>
        <script src="amcharts/serial.js" type="text/javascript"></script>
		<script src="amcharts/pie.js" type="text/javascript"></script>
	</head>
	<body>
		<h1>
			<?php
				$symbol = strtoupper($_POST['ETFsym']);
				include 'simple_html_dom.php';
				$url = 'https://www.spdrs.com/product/fund.seam?ticker=' . $symbol;
				$html = file_get_html($url);
				$date = $html->find('div[class="asOf stacked"]', 0);
				if ($date == null) {
					echo '<script>document.location.href=\'user_area_page.php?symbol=unknown\'</script>';
				}
				echo $date;
			?>
		</h1>
		<div id = "results">
			<?php
			echo 'Displaying ETF Data for Symbol: ' . $symbol;
			foreach($html->find('div[id=FUND_TOP_HOLDINGS]') as $element) {
				$companies = [];
				foreach($element->find('td[class=label]') as $company) {
					array_push($companies, $company);
				}
				$weight = [];
				$shares_held = [];
				foreach($element->find('td[class=data]') as $data) {
					if (strpos($data, '%') !== false) {
						array_push($weight, $data);
					}
					else array_push($shares_held, $data);
				}
			}
			?>
			<p>Fund Objective: </p>
			<?php
				$objective = $html->find('div.objective p', 0);
				#$description = $objective->children([0]);
				echo $objective;				
			?>
			<p>Top Ten Fund Holders: </p>
			<?php
			# Creating arrays to be formatted into CSV file
				$company1 = array($companies[0]->plaintext, $weight[0]->plaintext, $shares_held[0]->plaintext);
				$company2 = array($companies[1]->plaintext, $weight[1]->plaintext, $shares_held[1]->plaintext);
				$company3 = array($companies[2]->plaintext, $weight[2]->plaintext, $shares_held[2]->plaintext);
				$company4 = array($companies[3]->plaintext, $weight[3]->plaintext, $shares_held[3]->plaintext);
				$company5 = array($companies[4]->plaintext, $weight[4]->plaintext, $shares_held[4]->plaintext);
				$company6 = array($companies[5]->plaintext, $weight[5]->plaintext, $shares_held[5]->plaintext);
				$company7 = array($companies[6]->plaintext, $weight[6]->plaintext, $shares_held[6]->plaintext);
				$company8 = array($companies[7]->plaintext, $weight[7]->plaintext, $shares_held[7]->plaintext);
				$company9 = array($companies[8]->plaintext, $weight[8]->plaintext, $shares_held[8]->plaintext);
				$company10 = array($companies[9]->plaintext, $weight[9]->plaintext, $shares_held[9]->plaintext);
			# Displaying data in html table format	
				echo "
				<table border = \"2\" width = 50%>
					<tr>
						<th>Name</th>
						<th>Weight</th>
						<th>Shares Held</th>
					</tr>";
			# div containing the pie chart
				echo "<div id='chartdivpie' style='width: 50%; height: 600px;'></div>";

				for ($x = 0; $x < count($companies); $x++) {
					echo "<tr><td>".$companies[$x]->plaintext."</td>
							  <td>".$weight[$x]->plaintext."</td>
							  <td>".$shares_held[$x]->plaintext."</td>
						  </tr>";
				} 
				echo "</table>";

			?>
			<?php				
			# $data contains all data to be saved into CSV file
			$data = array
				(
				implode (' , ', $company1),
				implode (' , ', $company2),
				implode (' , ', $company3),
				implode (' , ', $company4),
				implode (' , ', $company5),
				implode (' , ', $company6),
				implode (' , ', $company7),
				implode (' , ', $company8),
				implode (' , ', $company9),
				implode (' , ', $company10)			
				);
	
		$file = fopen("ETFData.csv","w");

	foreach ($data as $company) {
		fputcsv($file, explode(', ' , $company));
	}

	fclose($file);
				?>
		</div>
<?php 
# Bar Chart
echo '
		 <script>
            var chart;
            var chartData = 
			[
                {
                    "Company": "'. $companies[0]->plaintext .'",
                    "Shares": '.intval(str_replace(",","",$shares_held[0]->plaintext)).',
                    "color": "#ffff66"
                },
                {
                    "Company": "'.$companies[1]->plaintext.'",
                    "Shares": '.intval(str_replace(",","",$shares_held[1]->plaintext)).',
                    "color": "#3399ff"
                },
                {
                    "Company": "'.$companies[2]->plaintext.'",
                    "Shares": '.intval(str_replace(",","",$shares_held[2]->plaintext)).',
                    "color": "#ffa31a"
                },
                {
                    "Company": "'.$companies[3]->plaintext.'",
                    "Shares": '.intval(str_replace(",","",$shares_held[3]->plaintext)).',
                    "color": "#ff66cc"
                },
                {
                    "Company": "'.$companies[4]->plaintext.'",
                    "Shares": '.intval(str_replace(",","",$shares_held[4]->plaintext)).',
                    "color": "#ff3333"
                },
                {
                    "Company": "'.$companies[5]->plaintext.'",
                    "Shares": '.intval(str_replace(",","",$shares_held[5]->plaintext)).',
                    "color": "#4dff4d"
                },
                {
                    "Company": "'.$companies[6]->plaintext.'",
                    "Shares": '.intval(str_replace(",","",$shares_held[6]->plaintext)).',
                    "color": "#0066ff"
                },
                {
                    "Company": "'.$companies[7]->plaintext.'",
                    "Shares": '.intval(str_replace(",","",$shares_held[7]->plaintext)).',
                    "color": "#ff0066"
                },
                {
                    "Company": "'.$companies[8]->plaintext.'",
                    "Shares": '.intval(str_replace(",","",$shares_held[8]->plaintext)).',
                    "color": "#ff9966"
                },
                {
                    "Company": "'.$companies[9]->plaintext.'",
                    "Shares": '.intval(str_replace(",","",$shares_held[9]->plaintext)).',
                    "color": "#66ffcc"
                }
            ];


            AmCharts.ready(function () {
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "Company";
                chart.depth3D = 10;
                chart.angle = 20;

                var categoryAxis = chart.categoryAxis;
                categoryAxis.labelRotation = 45;
                categoryAxis.dashLength = 5;
                categoryAxis.gridPosition = "start";

                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.title = "Shares Held";
                valueAxis.dashLength = 5;
                chart.addValueAxis(valueAxis);

                var graph = new AmCharts.AmGraph();
                graph.valueField = "Shares";
                graph.colorField = "color";
                graph.balloonText = "<span style=\'font-size:14px\'>[[category]]: <b>[[value]]</b></span>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                chart.addGraph(graph);

                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart.addChartCursor(chartCursor);

                chart.creditsPosition = "top-right";

                chart.write("chartdiv");
            });
        </script>
		<div id = "chartdiv" style = "width: 50%; height: 400px;"></div>

		';
?>		

<?php
# Pie Chart
	echo '
	        <script>
            var piechart;
            var legend;

            var chartDatapie = [{
                Company: "'.$companies[0]->plaintext.'",
                Weight: '.floatval(str_replace("%","",$weight[0]->plaintext)).',
            }, {
                Company: "'.$companies[1]->plaintext.'",
                Weight: '.floatval(str_replace("%","",$weight[1]->plaintext)).',
            }, {
                Company: "'.$companies[2]->plaintext.'",
                Weight: '.floatval(str_replace("%","",$weight[2]->plaintext)).',
            }, {
                Company: "'.$companies[3]->plaintext.'",
                Weight: '.floatval(str_replace("%","",$weight[3]->plaintext)).',
            }, {
                Company: "'.$companies[4]->plaintext.'",
                Weight: '.floatval(str_replace("%","",$weight[4]->plaintext)).',
            }, {
                Company: "'.$companies[5]->plaintext.'",
                Weight: '.floatval(str_replace("%","",$weight[5]->plaintext)).',
            }, {
                Company: "'.$companies[6]->plaintext.'",
                Weight: '.floatval(str_replace("%","",$weight[6]->plaintext)).',
            }, {
				Company: "'.$companies[7]->plaintext.'",
				Weight: '.floatval(str_replace("%","",$weight[7]->plaintext)).',
			}, {
				Company: "'.$companies[8]->plaintext.'",
				Weight: '.floatval(str_replace("%","",$weight[8]->plaintext)).',
			}, {
				Company: "'.$companies[9]->plaintext.'",
				Weight: '.floatval(str_replace("%","",$weight[9]->plaintext)).',
			}, {
				Company: "Other Companies",
				Weight: 100 - ('.floatval(str_replace("%","",$weight[0]->plaintext)).'+
				'.floatval(str_replace("%","",$weight[1]->plaintext)).'+
				'.floatval(str_replace("%","",$weight[2]->plaintext)).'+
				'.floatval(str_replace("%","",$weight[3]->plaintext)).'+
				'.floatval(str_replace("%","",$weight[4]->plaintext)).'+
				'.floatval(str_replace("%","",$weight[5]->plaintext)).'+
				'.floatval(str_replace("%","",$weight[6]->plaintext)).'+
				'.floatval(str_replace("%","",$weight[7]->plaintext)).'+
				'.floatval(str_replace("%","",$weight[8]->plaintext)).'+
				'.floatval(str_replace("%","",$weight[9]->plaintext)).')
			}
			];

            AmCharts.ready(function () {
                piechart = new AmCharts.AmPieChart();
                piechart.dataProvider = chartDatapie;
                piechart.titleField = "Company";
                piechart.valueField = "Weight";
                piechart.outlineColor = "#FFFFFF";
                piechart.outlineAlpha = 0.8;
                piechart.outlineThickness = 2;

                piechart.write("chartdivpie");
            });
			
        </script>
		';
?>	
<div class="wrapper">
   <input class = "button" type = "button" onclick = "window.location = 'user_area_page.php'" value = "Search For New Symbol"></input>
   <input class = "button" type = "button" onclick = "window.location = 'Login.html'" value = "Return to Login Page"></input>
</div>
<div>
</div>
</body>
</html>