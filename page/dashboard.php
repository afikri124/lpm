<?php
    include "config/config.php";
    $query = mysqli_query($con, "SELECT * FROM dosen");
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Penilaian Dosen</title>   
</head>

<body>
  <div class="container">
              <h1>Data Peer Observation</h1> 
    <table class="table table-hover table-striped">
        <thead>
            <tr>
            <th>NIDN</th>
            <th>Nama</th>
            <th>Fakultas</th>
            <th>Jurusan</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            while ($row = mysqli_fetch_array($query)) { 
            
            $nidn       = $row['nidn'];
            $checkValid = "
                           SELECT * FROM data_nilai
                           WHERE id_dosen = $nidn GROUP BY id_user

                          ";
            $checkValid = mysqli_query($con, $checkValid);
            $checkRow   = mysqli_num_rows($checkValid);

            ?>
            <tr> 
                <td><?php echo $row['nidn']; ?></td>
                <td><?php echo $row['nama_dosen']; ?></td>
                <td><?php echo $row['fakultas']; ?></td>
                <td><?php echo $row['jurusan']; ?></td>
                <td><?php 
                        if ($checkRow > 0) {
                    ?>
                            <a href = '' class="btn btn-success btn-fill btn-sm">Sudah dinilai</a>
                    <?php
                        }
                        else{
                    ?>
                            <a href = '' class="btn btn-danger btn-fill btn-sm">Belum dinilai</a>
                    <?php
                        }
                    ?>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

</div>

</body>
</html>
