<?php
include "config/config.php";
$id_auditor = $_GET['id_auditor'];
$query = '';
$query = mysqli_query($con, "SELECT 
    dosen.nidn,
    dosen.kategori,
    dosen.nama_dosen,
    dosen.fakultas,
    dosen.jurusan,
    dosen.alamat,
    penugasan.id_auditor,
    penugasan.id_dosen
    FROM dosen 
    LEFT JOIN penugasan ON dosen.nidn = penugasan.id_dosen 
    WHERE penugasan.id_auditor IS NULL AND dosen.kategori = 2 
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
                            <td><a href = "action/tambah_penugasan.php?id_auditor=<?php echo $id_auditor; ?>&nidn=<?php echo $row['nidn']; ?>" onclick="return confirm('Anda yakin akan menambahkan')" class="btn btn-success btn-fill btn-sm">
                                Tambah
                            </a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>