<?php


$id_auditor = $_SESSION['id_user'];
$query = mysqli_query($con, "SELECT * FROM dosen a
  INNER JOIN penugasan b ON a.nidn = b.id_dosen
  WHERE b.id_auditor = $id_auditor");

  ?>



  <!DOCTYPE html>

  <html >

  <head>

    <meta charset="UTF-8">

    <title>Penilaian Dosen</title>   

  </head>



  <body>

    <div class="container">

      <h3>Penilaian Dosen Oleh Auditor</h3>

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

              if ($_SESSION['id_user'] != $row['nidn']) {
              # code...
                

                ?>

                <tr> 

                  <td><?php echo $row['nidn']; ?></td>

                  <td><?php echo $row['nama_dosen']; ?></td>

                  <td><?php echo $row['fakultas']; ?></td>

                  <td><?php echo $row['jurusan']; ?></td>

                  <td><?php 

                  if ($checkRow > 0) {


                    ?>

                    <a href = '' class="btn btn-success btn-fill btn-sm">Sudah Dinilai</a>

                    <?php

                  }

                  else{

                    ?>

                    <a href="index.php?page=nilai_dosen&id_dosen=<?php echo $row['nidn']?>" class="btn btn-info btn-fill btn-sm">Nilai Dosen</a>

                    <?php

                  }

                  ?>

                </tr>

                <?php
              }
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

