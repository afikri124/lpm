<?php
include "config/config.php"; 


$data 	= array();
$bobot 	= array();

$id_dosen 	= 0;


$getRow 	= mysqli_query($con, "SELECT * FROM tbl_kriteria");
$rw 		= mysqli_num_rows($getRow);

	// echo $rw;


	# create Array
$getKriteria = mysqli_query($con, "SELECT * FROM tbl_kriteria");
while ($rowK = mysqli_fetch_array($getKriteria)) {
	

	$bobot[$rowK['id_kriteria']]	= $rowK['bobot']; 
	$i 		= 0;
	$getTrx	= mysqli_query($con, "SELECT * FROM data_nilai WHERE id_kriteria = ".$rowK['id_kriteria']."");
	while ($rowTrx = mysqli_fetch_array($getTrx)) {

		$data[$rowTrx['id_kriteria']][$rowTrx['id_dosen']][$i] = $rowTrx['nilai'];  

		$i++;

	} 

}

$data_count = array();
$max		= array();
$min 		= array();
$diff 		= array();

	# first step
foreach ($data as $key => $value) { 
	foreach ($value as $id_dsn => $value_dsn) {
		$average = array_sum($value[$id_dsn])/count($value[$id_dsn]);
		$data_count[$key][$id_dsn] = $average; 
	}
};


	# sort min max
foreach ($data_count as $key => $value) { 
	$max[$key] = max($value);
	$min[$key] = min($value);
}


	# diff
foreach ($max as $key => $value) { 
	$diff[$key] = $max[$key] - $min[$key]; 
} 

	# count Stats
$countStat 	= array();
$countAll 	= array();
foreach ($data_count as $key => $value) {
	foreach ($value as $key_val => $value_val) { 
		$countStat[$key][$key_val] = ($value_val - $min[$key])/$diff[$key];
		$countAll[$key][$key_val] = (($value_val - $min[$key])/$diff[$key])*$bobot[$key];
	}
}



	# sum all param
$sumAll 	= array();
$i = 0;
foreach ($countAll as $key => $value) {
	foreach ($value as $key_val => $value_val) {
		$sumAll[$key_val][$i] = $value_val;
	}
	$i++;
}


	# convert results
$results 	= array(); 
foreach ($sumAll as $key => $value) {  
	$results[$key] = array_sum($value); 
}

	# sort max to min
arsort($results);

$convert = array();
foreach ($results as $key => $value) { 
		// echo $value;
	$convert['id'][$key] 		= $key;
	$convert['val'][$key]		= $value; 
}


$x = json_encode($results);


?>
<body>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="header">
							<h2 class="title col-md-12">Diagram Hasil Perhitungan Metode MAUT</h2>
						</div>
						<div class="content table-responsive ">
							<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js" integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
							<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


							<div class="chart-container" style="width: 600px; height: 300px;">
								<canvas id="myChart"></canvas>
							</div>
							<script type="text/javascript">
								$.getJSON( "https://localhost/kinerjadosen/page/data.php", function( data ) { 

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
			color.push(dynamicColors());
			line.push(dynamicLine());
		});    
		console.log(isi_labels);
		console.log(isi_data);


		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
			type: 'bar',
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

</div>
</div>                
</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h2 class="title col-md-12">Peringkat Hasil Perhitungan Metode MAUT</h2>
			</div>
			<div class="content table-responsive ">
				<table class="table table-hover table-striped">
					<thead>
						<th>PERINGKAT</th>
						<th>Nama</th>
						<th>Hasil</th>
						<th>Keputusan</th>
					</thead>
					<tbody>
						<?php
						$i = 1;
						foreach ($results as $key => $value) {
							$query = mysqli_query ($con, "SELECT * FROM dosen WHERE nidn = $key");
							$row 	= mysqli_fetch_array ($query);
							
							?>
							<tr> 
								<td>Peringkat Ke - <?php echo $i; ?></td>
								<!-- <td><?php echo $row['nidn']; ?></td> -->
								<td><?php echo $row['nama_dosen']; ?></td>
								<td><?php echo  /*floor(*/strval($value)/**100)/1*/;?></td>
								<td><?php  if($value >= 0.85){ echo 'Sangat Baik'; } 
								else if($value < 0.85 && $value >= 0.7) { echo 'Baik';}
								else if($value < 0.7 && $value >= 0.5) { echo 'Cukup Baik';}
								else if($value < 0.5 && $value >= 0.3) { echo 'Cukup';}
								else if($value < 0.3 && $value >= 0) { echo 'Kurang Dari Cukup';}?></td>
							</tr>

							<?php
							$i++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>                
	</div>
</div>
</div>
</div>
</body>

