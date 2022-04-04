<?php
include "config/config.php";

$query   = "
SELECT
mahasiswa.npm,
mahasiswa.nama_mhs,
mahasiswa.jurusan,
data_nilai.id_user,
data_nilai.id_dosen,
data_nilai.id_kriteria,
data_nilai.nilai
FROM mahasiswa
LEFT JOIN data_nilai ON mahasiswa.npm = data_nilai.id_user
GROUP BY mahasiswa.npm
";

$getRowx = mysqli_query($con, $query);

$q       = mysqli_query($con, "SELECT * FROM dosen WHERE kategori = 2");
$rwm     = mysqli_num_rows($q);
?>

<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">Rekap Penilaian</h4>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>                                   
                    <th>Jumlah dosen</th>
                    <th>Jumlah Kriteria Yang Dinilai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($rows = mysqli_fetch_array($getRowx)) {
                    $x           = mysqli_query($con, "SELECT * FROM data_nilai WHERE id_user = $rows[npm]");
                    $xxx    = mysqli_num_rows($x);
                    
                    ?>
                    <tr>
                        <td><?php echo $rows['npm']; ?></td>
                        <td><?php echo $rows['nama_mhs']; ?></td>
                        <td><?php echo $rows['jurusan']; ?></td>
                        <td><?php echo $rwm; ?></td>
                        <td><?php echo floor($xxx/(5+$rwm)); ?></td>
                        <td><a href="index.php?page=rekap_mhs&npm=<?php echo $rows['npm']; ?>" class="btn btn-info btn-fill btn-sm">Lihat</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>