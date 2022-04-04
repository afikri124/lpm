<?php
	include "../config/config.php";

	if(isset($_GET['npm']) && $_GET['npm']){
		$npm	= $_GET['npm'];

		$query	= mysqli_query($con, "DELETE FROM mahasiswa WHERE npm = '$npm'");

		if ($query) {
		echo "<script>alert('Berhasil Dihapus'); location.href='../index.php?page=mahasiswa'</script>";
		}
		else{
			echo "Error";
		}
	}	