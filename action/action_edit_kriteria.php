<?php
    include "../config/config.php";

    $kategori                = $_POST['kategori'];
    $kode_kriteria           = $_POST['kode_kriteria'];
    $kriteria                = $_POST['kriteria'];
    $bobot                   = $_POST['bobot'];

    $sql                = "UPDATE tbl_kriteria SET
                            kategori             = '$kategori',
                            kode_kriteria        = '$kode_kriteria',
                            kriteria             = '$kriteria',
                            bobot                = '$bobot'
                            
                            WHERE
                        
                            kode_kriteria          = '$kode_kriteria'
                        ";


    if (mysqli_query($con, $sql)){
        echo "<script>alert('Berhasil Simpan Data'); location.href='../index.php?page=kriteria'</script>";
    }
    else{
        echo "Error";
    }
?>
