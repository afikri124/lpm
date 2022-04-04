<?php
	include "../config/config.php";

	$kategori			= $_POST['kategori'];
	$kode_kriteria		= $_POST['kode_kriteria'];
	$kriteria			= $_POST['kriteria'];
	$bobot				= $_POST['bobot'];

	$sql				= "INSERT INTO tbl_kriteria (
							kategori,
							kode_kriteria,
							kriteria,
							bobot
						) VALUES
						(
							'$kategori',
							'$kode_kriteria',
							'$kriteria',
							'$bobot'
						)";

	if (mysqli_query($con, $sql)){
		echo "<script>alert('Berhasil Simpan Data'); location.href='../index.php?page=kriteria'</script>";
	}
	else{
		echo "Error";
	}
?>