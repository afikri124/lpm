<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js" integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>




<div class="chart-container" style="width: 1000px; height: 1000px;">
	<canvas id="myChart"></canvas>
</div>
<script type="text/javascript">
	$.getJSON( "https://localhost/kinerjadosen/page/data.php?page=sort", function( data ) { 

	    var isi_labels 		= [];
	    var isi_data		= [];
	    var color 			= [];
	    var line 			= [];

		var dynamicColors = function() {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgba(" + r + "," + g + "," + b + ", 0.3)";
		};

		var dynamicLine = function() {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		};

		// alert(data);

	    $(data).each(function(i){         
	        isi_labels.push(data[i].nama); 
	        isi_data.push(data[i].val);
	       	color.push(data[i].color);
	        line.push(dynamicLine());
	    });    
	    console.log(isi_labels);
	    console.log(isi_data);


	    var ctx = document.getElementById('myChart').getContext('2d');
	    var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: isi_labels,
                        datasets: [{
                            label: 'Hasil Perhitungan',
                            backgroundColor: color,
                            borderColor: line,
                            data: isi_data
                        }]
                    },
                    options: {}
                });
	});
</script>

