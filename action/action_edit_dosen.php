<?php
    include "../config/config.php";

    $nidn                 = $_POST['nidn'];
    $kategori             = $_POST['kategori'];
    $nama_dosen           = $_POST['nama_dosen'];
    $fakultas             = $_POST['fakultas'];
    $jurusan              = $_POST['jurusan'];   
    $alamat               = $_POST['alamat'];
    $username_dosen       = $_POST['username_dosen'];
    $password_dosen       = md5($_POST['password_dosen']);

    $sql                = "UPDATE dosen SET
                            nidn              = '$nidn',
                            kategori          = '$kategori',
                            nama_dosen        = '$nama_dosen',
                            fakultas          = '$fakultas',
                            jurusan           = '$jurusan',                           
                            alamat            = '$alamat',
                            username_dosen    = '$username_dosen',
                            password_dosen    = '$password_dosen'
                            
                            WHERE
                        
                            nidn              = '$nidn'
                        ";


    if (mysqli_query($con, $sql)){
        echo "<script>alert('Berhasil Simpan Data'); location.href='../index.php?page=dosen'</script>";
    }
    else{
        echo "Error";
    }
?>
