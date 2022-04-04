<?php
	include "../config/config.php";
	print_r($_POST);
	$npm				= $_POST['npm'];
	$nama_mhs			= $_POST['nama_mhs'];
	$jurusan			= $_POST['jurusan'];
	$alamat				= $_POST['alamat'];
	$username_mhs		= $_POST['username_mhs'];
	$password_mhs		= md5($_POST['password_mhs']);

	$sql				= "INSERT INTO mahasiswa (
							npm,
							nama_mhs,
							jurusan,
							alamat,
							username_mhs,
							password_mhs
						) VALUES
						(
							'$npm',
							'$nama_mhs',
							'$jurusan',
							'$alamat',
							'$username_mhs',
							'$password_mhs'
						)";


	if (mysqli_query($con, $sql)){
		echo "<script>alert('Berhasil Simpan Data'); location.href='index.php?page=login_mhs'</script>";
	}
	else{
		echo "Error";
	}
?>
