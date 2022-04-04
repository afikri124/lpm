<?php
	include "../config/config.php";

	$nidn				= $_POST['nidn'];
	$kategori			= $_POST['kategori'];
	$nama_dosen			= $_POST['nama_dosen'];
	$fakultas			= $_POST['fakultas'];
	$jurusan			= $_POST['jurusan'];
	$alamat				= $_POST['alamat'];
	$username_dosen		= $_POST['username_dosen'];
	$password_dosen		= md5($_POST['password_dosen']);

	$sql				= "INSERT INTO dosen (
							nidn,
							kategori,
							nama_dosen,
							fakultas,
							jurusan,
							alamat,
							username_dosen,
							password_dosen
						) VALUES
						(
							'$nidn',
							'$kategori',
							'$nama_dosen',
							'$fakultas',
							'$jurusan',
							'$alamat',
							'$username_dosen',
							'$password_dosen'
						)";

	if (mysqli_query($con, $sql)){
		echo "<script>alert('Berhasil Simpan Data'); location.href='../index.php?page=dosen'</script>";
	}
	else{
		echo "Error";
	}
?>