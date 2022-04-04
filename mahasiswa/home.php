<?php

    $query = mysqli_query($con, "SELECT * FROM dosen WHERE kategori LIKE '2' ");
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Penilaian Dosen</title>
</head>

<body>
  <div class="container">
              <h1>Penilaian Dosen Oleh Mahasiswa</h1>
              <?php 
              $cek_jadwal = mysqli_query($con, "SELECT * FROM jadwal ORDER BY id_jadwal DESC LIMIT 0,1");
              $jadwal      = mysqli_fetch_array($cek_jadwal);
              $today = date('Y-m-d');


              if ($jadwal['mulai'] <= $today && $jadwal['berakhir'] >= $today) {
                  
              ?>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
            <th>NIDN</th>
            <th>Nama</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($query)) { 
                                                
            ?>
            <tr> 
                <td><?php echo $row['nidn']; ?></td>
                <td><?php echo $row['nama_dosen']; ?></td>
                <td><a href="index.php?page=nilai_dosen&id_dosen=<?php echo $row['nidn']?>" class="btn btn-info btn-fill btn-sm">Nilai Dosen</a></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    <?php
}

    else {
        echo "PENILAIAN BELUM TERSEDIA";
    }
?>

</div>

</body>
</html>
