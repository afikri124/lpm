<?php
include "config/config.php";
$query = '';
$cari = '';
if (isset($_GET['cari']) && $_GET['cari']) {
    $cari = $_GET['cari'];

    $query = mysqli_query($con, "SELECT * FROM mahasiswa WHERE npm LIKE '%$cari%' OR nama_mhs LIKE '%$cari%' ");
} else {
    $query = mysqli_query($con, "SELECT * FROM mahasiswa");
}

?>


<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">DATA MAHASISWA</h4><a href = 'index.php?page=tambah_mahasiswa' class="btn btn-success btn-fill btn-sm">Tambah Mahasiswa</a>
        <form>
            <input type="hidden" name="page" value="mahasiswa" /> 
            <input type="text" name="cari" placeholder="Cari Data" /> 
            <input type="submit" name="" value="Search" />
        </form>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr><th>NPM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr></thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($query)) { 

                        ?>
                        <tr>
                            <td><?php echo $row['npm']; ?></td>
                            <td><?php echo $row['nama_mhs']; ?></td>
                            <td><?php echo $row['jurusan']; ?></td>
                            <td><?php echo $row['kelas']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><a href="index.php?page=edit_mahasiswa&npm=<?php echo $row['npm']?>" class="btn btn-info btn-fill btn-sm">EDIT</a></td>
                            <td><a href="action/delete_msh.php?page=hapus&npm=<?php echo $row['npm']?>" class="btn btn-danger btn-fill btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?');">DELET</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
