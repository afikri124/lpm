<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data nilai.xls");
include "../config/config.php";

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
where auditor.kategori = 0 OR auditor.kategori = 1
";

$query = mysqli_query($con, $sql);
?>


<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">DATA PENILAIAN AUDITOR</h4>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table border="1px">

            <thead>

                <tr><!-- <th>NIDN</th> -->
                    <th>Nama Auditor</th>
                    <!-- <th>Kriteria</th> -->
                    <th>Nama Dosen</th>
                    <th>Nilai</th>
                </tr></thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($query)) { 
                        
                        ?>
                        <tr>
                            <!-- <td><?php echo $row['id_auditor']; ?></td> -->
                            <td><?php echo $row['nama_auditor']; ?></td>
                            <!-- <td><?php echo $row['kriteria']; ?></td> -->
                            <td><?php echo $row['nama_dosen']; ?></td>
                            <td><?php echo $row['nilai']; ?></td>
                            
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
