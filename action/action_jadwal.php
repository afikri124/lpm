<?php
	include "../config/config.php";

	$mulai			= $_POST['mulai'];
	$berakhir		= $_POST['berakhir'];


	$sql				= "INSERT INTO jadwal (
							mulai,
							berakhir

						) VALUES
						(
							'$mulai',
							'$berakhir'

						)";

	if (mysqli_query($con, $sql)){
		echo "<script>alert('Berhasil Simpan Data'); location.href='../index.php?page=jadwal'</script>";
	}
	else{
		echo "Error";
	}
?>