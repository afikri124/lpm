<?php
include "../config/config.php";

if(isset($_GET['id']) && $_GET['id']){
	$id	= $_GET['id'];

	$query	= mysqli_query($con, "DELETE FROM penugasan WHERE id = '$id'");

	if ($query) {
		echo "<script>alert('Berhasil Dihapus'); location.href='../index.php?page=penugasan'</script>";
	}
	else{
		echo "Error";
	}
}	