<?php
	include "../config/config.php";

	if(isset($_GET['nidn']) && $_GET['nidn']){
		$nidn	= $_GET['nidn'];

		$query	= mysqli_query($con, "DELETE FROM dosen WHERE nidn = '$nidn'");

		if ($query) {
		echo "<script>alert('Berhasil Dihapus'); location.href='../index.php?page=dosen'</script>";
		}
		else{
			echo "Error";
		}
	}	