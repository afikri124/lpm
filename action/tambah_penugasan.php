<?php
include "../config/config.php";
if($_GET){

	$id_auditor		= $_GET['id_auditor'];
	$nidn			= $_GET['nidn'];
	
	#do insert
	$query 		= mysqli_query($con, "INSERT INTO penugasan(id_auditor, id_dosen) VALUES('$id_auditor', '$nidn')");	
	if ($query){
		echo "<script>alert('Berhasil Simpan Data'); 
		history.go(-1);</script>";
	}
	else{
		echo "<script>alert('Data Gagal Disimpan!!!!'); 
		history.go(-1);</script>";
	}
}
?>