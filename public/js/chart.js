function drawChart(data, cid, tid) {
			var data = google.visualization.arrayToDataTable(data);
			
			var options = {
					"width": "100%",
					"height": 600
			};
			var tableOptions = {
					"width": "100%",
					//"height":400
			};
			var chart = new google.visualization.PieChart(document.getElementById(cid));
			chart.draw(data, options);
			
			var table = new google.visualization.Table(document.getElementById(tid));
			table.draw(data, tableOptions);
}

function drawBarChart(data, cid, tid) {
			var data = google.visualization.arrayToDataTable(data);
			
			var options = {
					"width": "100%",
					"height": 400
			};
			var tableOptions = {
					"width": "100%",
					//"height":400
			};
			var chart = new google.visualization.ColumnChart(document.getElementById(cid));
			chart.draw(data, options);
			
			var table = new google.visualization.Table(document.getElementById(tid));
			table.draw(data, tableOptions);
}

function drawChartNew (type, data, chartId) {
    if (type == 'bar') {
		//alert(data);
        drawBarChartNew (data, chartId);
    } else if (type == 'pie') {
        drawPieChartNew (data, chartId);
    } else if (type == 'line') {
        drawLineChartNew (data, chartId);
    } else if (type == 'donut') {
        drawDonutChartNew (data, chartId);
    } else if (type == 'column') {
        drawColumnChart (data, chartId);
    }
}
function drawBarChartNew (data, chartId) {
            var colLength = data[0].length - 1;
			var data = google.visualization.arrayToDataTable(data);
			var formatter = new google.visualization.NumberFormat({pattern: '#\'%\''});
			// format column 1 of the DataTable
			formatter.format(data, 1);
			// set the height for padding(padding height)
			var pH = 30;

			// get total height of rows (row height)
			var rH = data.getNumberOfRows() * 20 * 2;

			// total chart height (chart height)
			var cH = (rH + pH)*colLength;
            //var length = data[0].length;
			var options = {
					'minValue': 0,
					'maxValue': 100,
					"width": "90%",
					"height": cH,
					'chartArea': {'top': '0%'},
					"legend": "none",
					hAxis: {
						format: '#\'%\'',						
						ticks: [0, 25, 50, 75, 100] 
					} 
					
			};
			
			var chart = new google.visualization.BarChart(document.getElementById(chartId));
			chart.draw(data, options);
}

function drawColumnChart (data, chartId) {
            var colLength = data[0].length - 1;
			var data = google.visualization.arrayToDataTable(data);
			var formatter = new google.visualization.NumberFormat({pattern: '#\'%\''});
			// format column 1 of the DataTable
			formatter.format(data, 1);
			// set the height for padding(padding height)
			var pH = 30;

			// get total height of rows (row height)
			var rH = data.getNumberOfRows() * 20 * 2;

			// total chart height (chart height)
			var cH = (rH + pH)*colLength;
            //var length = data[0].length;
			var options = {
					'minValue': 0,
					'maxValue': 100,
					"width": "90%",
					"height": 400,
                    legend: { position: 'bottom', alignment: 'start' },
					hAxis: {
						format: '#\'%\'',						
						ticks: [0, 25, 50, 75, 100] 
					} 
					
			};
			
			var chart = new google.visualization.ColumnChart(document.getElementById(chartId));
			chart.draw(data, options);
}

function drawPieChartNew (data, chartId) {
			var data = google.visualization.arrayToDataTable(data);
		
			var options = {
					
			};
			
			var chart = new google.visualization.PieChart(document.getElementById(chartId));
			chart.draw(data, options);
}

function drawDonutChartNew (data, chartId) {
			var data = google.visualization.arrayToDataTable(data);
		
			var formatter = new google.visualization.NumberFormat({pattern: '#\'%\''});
			// format column 1 of the DataTable
			formatter.format(data, 1);
			// set the height for padding(padding height)
			var pH = 30;

			// get total height of rows (row height)
			var rH = data.getNumberOfRows() * 20 * 2;

			// total chart height (chart height)
			var cH = rH + pH;
			var options = {
					'minValue': 0,
					'maxValue': 100,
					"width": "100%",
					"height": cH,
					'chartArea': {'top': '0%'},
                    "pieHole": 0.4,
					hAxis: {
						format: '#\'%\'',						
						ticks: [0, 25, 50, 75, 100] 
					} 
					
			};
			
			var chart = new google.visualization.PieChart(document.getElementById(chartId));
			chart.draw(data, options);
}
function drawLineChartNew (data, chartId) {
			var data = google.visualization.arrayToDataTable(data);
		
			var formatter = new google.visualization.NumberFormat({pattern: '#\'%\''});
			// format column 1 of the DataTable
			formatter.format(data, 1);
			// set the height for padding(padding height)
			var pH = 30;

			// get total height of rows (row height)
			var rH = data.getNumberOfRows() * 20 * 2;

			// total chart height (chart height)
			var cH = rH + pH;
			var options = {
					"legend": "none",
                    pointSize: 5,
					hAxis: {
						format: '#\'%\'',						
						ticks: [0, 25, 50, 75, 100] 
					} 
					
			};
			
			var chart = new google.visualization.LineChart(document.getElementById(chartId));
			chart.draw(data, options);
}

function drawTableNew(data, chartId) {
			var data = google.visualization.arrayToDataTable(data);
		
			var options = {
					"width": "100%",
					//"height":400
			};
			
			
			var table = new google.visualization.Table(document.getElementById(chartId));
			table.draw(data, options);
}

function drawBar1Chart(data, tableData, cid, tid) {
			var data = google.visualization.arrayToDataTable(data);
			var tableData = google.visualization.arrayToDataTable(tableData);
			
			var formatter = new google.visualization.NumberFormat({pattern: '#\'%\''});
			// format column 1 of the DataTable
			formatter.format(data, 1);
			// set the height for padding(padding height)
			var pH = 30;

			// get total height of rows (row height)
			var rH = data.getNumberOfRows() * 20 * 2;

			// total chart height (chart height)
			var cH = rH + pH;
			var options = {
					'minValue': 0,
					'maxValue': 100,
					"width": "90%",
					"height": cH,
					'chartArea': {'top': '0%'},
					"legend": "none",
					hAxis: {format: '#\'%\''} 
					
			};
			var tableOptions = {
					"width": "100%",
					//"height":400
			};
			
			var chart = new google.visualization.BarChart(document.getElementById(cid));
			chart.draw(data, options);
			
			var table = new google.visualization.Table(document.getElementById(tid));
			table.draw(tableData, tableOptions);
}