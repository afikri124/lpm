<?php
	include "../config/config.php";

	if(isset($_GET['kode_kriteria']) && $_GET['kode_kriteria']){
		$kode_kriteria	= $_GET['kode_kriteria'];

		$query	= mysqli_query($con, "DELETE FROM tbl_kriteria WHERE kode_kriteria = '$kode_kriteria'");

		if ($query) {
		echo "<script>alert('Berhasil Dihapus'); location.href='../index.php?page=kriteria'</script>";
		}
		else{
			echo "Error";
		}
	}	