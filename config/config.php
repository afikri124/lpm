<?php
$con = mysqli_connect("localhost",'root',"itkj@1122sql",'kinerja_dosen');

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>