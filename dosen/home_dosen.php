<?php



$data   = array();

$bobot  = array();



$id_dosen   = 0;





$getRow     = mysqli_query($con, "SELECT * FROM tbl_kriteria");

$rw         = mysqli_num_rows($getRow);



    // echo $rw;





    # create Array

$getKriteria = mysqli_query($con, "SELECT * FROM tbl_kriteria");

while ($rowK = mysqli_fetch_array($getKriteria)) {

    



    $bobot[$rowK['id_kriteria']]    = $rowK['bobot']; 

    $i      = 0;

    $getTrx = mysqli_query($con, "SELECT * FROM data_nilai WHERE id_kriteria = ".$rowK['id_kriteria']."");

    while ($rowTrx = mysqli_fetch_array($getTrx)) {



        $data[$rowTrx['id_kriteria']][$rowTrx['id_dosen']][$i] = $rowTrx['nilai'];  



        $i++;



    } 



}



$data_count = array();

$max        = array();

$min        = array();

$diff       = array();



    # first step

foreach ($data as $key => $value) { 

    foreach ($value as $id_dsn => $value_dsn) {

        $average = array_sum($value[$id_dsn])/count($value[$id_dsn]);

        $data_count[$key][$id_dsn] = $average; 

    }

};





    # sort min max

foreach ($data_count as $key => $value) { 

    $max[$key] = max($value);

    $min[$key] = min($value);

}





    # diff

foreach ($max as $key => $value) { 

    $diff[$key] = $max[$key] - $min[$key]; 

} 



    # count Stats

$countStat  = array();

$countAll   = array();

foreach ($data_count as $key => $value) {

    foreach ($value as $key_val => $value_val) { 

        $countStat[$key][$key_val] = ($value_val - $min[$key])/$diff[$key];

        $countAll[$key][$key_val] = (($value_val - $min[$key])/$diff[$key])*$bobot[$key];

    }

}







    # sum all param

$sumAll     = array();

$i = 0;

foreach ($countAll as $key => $value) {

    foreach ($value as $key_val => $value_val) {

        $sumAll[$key_val][$i] = $value_val;

    }

    $i++;

}





    # convert results

$results    = array(); 

foreach ($sumAll as $key => $value) {  

    $results[$key] = array_sum($value); 

}



    # sort max to min

arsort($results);



$convert = array();

foreach ($results as $key => $value) { 

        // echo $value;

    $convert['id'][$key]        = $key;

    $vonvert['val'][$key]       = $value; 

}





$x = json_encode($results);





?>



<div class="card-body table-responsive">

    <h3>Data Hasil Perhitungan Metode MAUT</h3>

    <table class="table table-hover table-striped">

        <thead>

            <tr>



                <th>PERINGKAT</th>

                <th>NIDN</th>

                <th>Nama</th>

                <th>Hasil</th>



            </tr>

        </thead>

        <tbody>

            <?php

            $i = 1;

            foreach ($results as $key => $value) {

                $query = mysqli_query ($con, "SELECT * FROM dosen WHERE nidn = $key");

                $row    = mysqli_fetch_array ($query);

                if($_SESSION['id_user'] == $key){                                   

                    ?>

                    <tr> 

                        <td>Peringkat Ke -<?php echo $i; ?></td>

                        <td><?php echo $row['nidn']; ?></td>

                        <td><?php echo $row['nama_dosen']; ?></td>

                        <td><?php echo  floor(strval($value)*100)/1;?>%</td>

                    </tr>



                    <?php

                }

                $i++;

            }

            ?>

        </tbody>

    </table>

</div>



<?php
$id = $_SESSION['id_user'];
$sql   = "SELECT
auditor.nidn AS id_auditor,
auditor.nama_dosen AS nama_auditor,
data_nilai.id_user,
data_nilai.id_kriteria,
data_nilai.nilai,
tbl_kriteria.kriteria,
tbl_kriteria.kode_kriteria,
data_nilai.id,

dosen.nidn,
dosen.nama_dosen
FROM dosen AS auditor 
INNER JOIN data_nilai ON auditor.nidn = data_nilai.id_user
INNER JOIN tbl_kriteria ON data_nilai.id_kriteria = tbl_kriteria.id_kriteria

INNER JOIN dosen ON data_nilai.id_dosen = dosen.nidn
WHERE data_nilai.id_dosen = $id
";

$query = mysqli_query($con, $sql);
?>


<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">Hasil Yang Perlu Di Evaluasi</h4>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped">
            <thead>

                <tr>

                    <th>Kriteria</th>


                </tr></thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($query)) { 
                        if ($row['nilai'] < 4) {
                                                # code...
                            
                            ?>
                            <tr>

                                <td><?php echo $row['kriteria']; ?></td>

                                
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>











