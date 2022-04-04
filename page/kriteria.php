<?php
    include "config/config.php";
    $query = mysqli_query($con, "SELECT * FROM tbl_kriteria");
?>

                        <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">DATA KRITERIA</h4><a href = 'index.php?page=tambah_kriteria' class="btn btn-success btn-fill btn-sm">Tambah Kriteria</a>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                            <th>Kategori</th>
                                            <th>Kode Kriteria</th>
                                            <th>Kriteria</th>
                                            <th>Bobot</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($query)) { 
                                                
                                            ?>
                                            <tr>
                                                <td><?php echo $row['kategori']; ?></td>
                                                <td><?php echo $row['kode_kriteria']; ?></td>
                                                <td><?php echo $row['kriteria']; ?></td>
                                                <td><?php echo $row['bobot']; ?></td>
                                                <td><a href="index.php?page=edit_kriteria&kode_kriteria=<?php echo $row['kode_kriteria']?>" class="btn btn-info btn-fill btn-sm">EDIT</a></td>
                                                <td><a href="action/delete_kriteria.php?page=hapus&kode_kriteria=<?php echo $row['kode_kriteria']?>" class="btn btn-danger btn-fill btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?');">DELET</a></td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>