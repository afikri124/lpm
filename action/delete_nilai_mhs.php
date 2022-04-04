<?php
	include "../config/config.php";

	if(isset($_GET['id']) && $_GET['id']){
		$id	= $_GET['id'];

		$query	= mysqli_query($con, "DELETE FROM data_nilai WHERE id = '$id'");

		if ($query) {
		echo "<script>alert('Berhasil Dihapus'); location.href='../index.php?page=penilaian_mhs'</script>";
		}
		else{
			echo "Error";
		}
	}	