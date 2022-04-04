<?php
include "config/config.php";
$id_auditor = $_GET['id_auditor'];
$query = '';
$query = mysqli_query($con, "SELECT * FROM dosen a
    INNER JOIN penugasan b ON a.nidn = b.id_dosen
    WHERE b.id_auditor = $id_auditor
    ");


// echo json_encode($query);

    ?>

    <div class="card strpied-tabled-with-hover">
        <div class="card-header ">
            <h4 class="card-title">DAFTAR DOSEN</h4>

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
                            <td><a href = "action/delete_penugasan.php?id=<?php echo $row['id']; ?>&nidn=<?php echo $row['nidn']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-fill btn-sm">
                                Hapus
                            </a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>