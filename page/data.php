<?php
	include "../config/config.php"; 


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
	ksort($results);

	$filter			= array();

	if(isset($_GET['page']) && $_GET['page'] == 'sort'){
		$i = 0;
		foreach ($results as $key => $value) {
			$getQ		= mysqli_query($con, "SELECT * FROM dosen WHERE nidn = $key");
			$row 		= mysqli_fetch_array($getQ);

			if ($i) 
				$filter[$i]['nama']		= $row['nama_dosen'];
				$trueVal 				= (strval($value)*100)/1;
				$filter[$i]['val']		= $trueVal;
				if($trueVal > 40){
					$filter[$i]['color']	= 'rgba(39, 174, 96,0.5)';
				}
				else{
					$filter[$i]['color']	= 'rgba(231, 76, 60,0.5)';
				
			}

			$i++;
		}
	}
	else{
		$i = 0;
		foreach ($results as $key => $value) {
			$getQ		= mysqli_query($con, "SELECT * FROM dosen WHERE nidn = $key");
			$row 		= mysqli_fetch_array($getQ);

			
			$filter[$i]['nama']		= $row['nama_dosen'];
			$filter[$i]['val']		= strval($value);

			$i++;
		}
	}

	echo json_encode($filter);