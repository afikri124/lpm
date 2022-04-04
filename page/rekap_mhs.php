<?php
include "config/config.php";
$npm = $_GET['npm'];
$query   = "
SELECT
dosen.nidn,
dosen.nama_dosen,
dosen.fakultas,
dosen.jurusan,
dosen.kategori,
count(data_nilai.id_user) AS 'total'
FROM dosen
LEFT JOIN data_nilai ON dosen.nidn = data_nilai.id_dosen
WHERE dosen.kategori = 2 AND data_nilai.id_user = $npm
GROUP BY dosen.nidn
";

$getRowx = mysqli_query($con, $query);

?>

<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">Dosen Yang Telah Dinilai</h4>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>NIDN</th>
                    <th>Nama</th> 
                    <th>Fakultas</th> 
                    <th>Jurusan</th> 
                    <th>Status</th>                                   
                </tr>
            </thead>
            <tbody>
                <?php
                while ($rows = mysqli_fetch_array($getRowx)) {
                    ?>
                    <tr>
                        <td><?php echo $rows['nidn']; ?></td>
                        <td><?php echo $rows['nama_dosen']; ?></td>
                        <td><?php echo $rows['fakultas']; ?></td>
                        <td><?php echo $rows['jurusan']; ?></td>
                        <td><?php
                        if ($rows['total'] > 0) {
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
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
</div>