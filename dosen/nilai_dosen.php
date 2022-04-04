

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Penilaian Dosen</title>

</head>


<body>
  <div class="container">
    <div class="card-header ">
      <h3>Form Penilaian Dosen Oleh Auditor</h3>
      <form action='' method='post'>
        <?php
        $id_dosen = $_GET['id_dosen'];
        $id_user  = $_SESSION['id_user'];
        include "../config/config.php";
        $check    = mysqli_query($con, "SELECT * FROM data_nilai WHERE id_user = '$id_user' AND id_dosen = $id_dosen");
        $getRow   = mysqli_num_rows($check);
        if($getRow > 0){
          echo "Sudah dinilai";
        }

        else{
          ?>
        </div>
        <table class="table table-hover table-striped">
          <thead>
            <tr>

              <th>Kriteria</th>
              <th>Nilai</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "../config/config.php";
            $krDosen = mysqli_query($con, "SELECT * FROM tbl_kriteria WHERE kategori = 1");
            $i = 0;
            while ($row = mysqli_fetch_array($krDosen)) {       
              ?>
              <tr>

                <td><div style="width: 500px;"><?php echo $row['kriteria']; ?></div></td>
                <td>
                  <label>
                   1 <input type='radio' name="nilai[<?php echo $i; ?>]" value="1"> 
                 </label>

                 <label>
                   2 <input type='radio' name="nilai[<?php echo $i; ?>]" value="2"> 
                 </label>

                 <label>
                   4 <input type='radio' name="nilai[<?php echo $i; ?>]" value="4"> 
                 </label>

                 <label>
                   5 <input type='radio' name="nilai[<?php echo $i; ?>]" value="5"> 
                 </label>

                 <label>
                   6 <input type='radio' name="nilai[<?php echo $i; ?>]" value="6"> 
                 </label>

                 <input type='hidden' name='id_dosen' value="<?php echo $_GET['id_dosen']; ?>">
                 <input type='hidden' name="id_kriteria[<?php echo $i; ?>]" value="<?php echo $row['id_kriteria']; ?>">
               </td>
             </tr>
             <?php
             $i++;
           }
           ?>
         </tbody>
         <tr>
           <td colspan="3" align="right">
            <input type="submit" name="simpan" value="Simpan Nilai"> 
          </td>
        </tr>  
      </table>
      <?php 
    } 
    ?>
    

  </form>
</div>

</body>
</html>