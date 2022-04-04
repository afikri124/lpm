<?php
    include "config/config.php";
    $query = '';
    $cari = '';
    if (isset($_GET['cari']) && $_GET['cari']) {
        $cari = $_GET['cari'];
        
        $query = mysqli_query($con, "SELECT * FROM dosen WHERE nidn LIKE '%$cari%' OR nama_dosen LIKE '%$cari%' ");
    } else {
        $query = mysqli_query($con, "SELECT * FROM dosen");
    }
    
?>

                        <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">DATA DOSEN</h4><a href = 'index.php?page=tambah_dosen' class="btn btn-success btn-fill btn-sm">Tambah Dosen</a> 
                                     <form action="index.php?page=dosen">
                                    <input type="text" name="cari" placeholder="Cari Data" /> 
                                    <input type="hidden" name="page" value="dosen" /> 
                                    <input type="submit" name="" value="Search" />
                                    </form>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                            <th>NIDN</th>
                                            <th>Nama</th>                                           
                                            <th>Fakultas</th>                                           
                                            <th>Jurusan</th>
                                            <th>Alamat</th>
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
                                                <td><?php echo $row['alamat']; ?></td>
                                                <td><a href="index.php?page=edit_dosen&nidn=<?php echo $row['nidn']?>" class="btn btn-info btn-fill btn-sm">EDIT</a></td>
                                                <td><a href="action/delete_dosen.php?page=hapus&nidn=<?php echo $row['nidn']?>" class="btn btn-danger btn-fill btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?');">DELETE</a></td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>