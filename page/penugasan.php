<?php
include "config/config.php";
$query = '';
$query = mysqli_query($con, "SELECT * FROM dosen WHERE kategori = 0 or kategori = 1");

?>

<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">PENUGASAN AUDITOR</h4>
    </div>
    <div class="card-body table-full-width table-responsive">
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
                    ?>
                    <tr>
                        <td><?php echo $row['nidn']; ?></td>
                        <td><?php echo $row['nama_dosen']; ?></td>
                        <td><?php echo $row['fakultas']; ?></td>
                        <td><?php echo $row['jurusan']; ?></td>
                        <td><a href="index.php?page=tambah_penugasan&id_auditor=<?php echo $row['nidn'] ?>" class="btn btn-success btn-fill btn-sm">penugasan</a></td>
                        <td><a href="index.php?page=data_penugasan&id_auditor=<?php echo $row['nidn'] ?>" class="btn btn-info btn-fill btn-sm">data penugasan</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>