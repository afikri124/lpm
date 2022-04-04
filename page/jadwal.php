<?php
    include "config/config.php";
    $query = mysqli_query($con, "SELECT * FROM jadwal");
?>


                        <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">PENJADWALAN</h4><a href = 'index.php?page=tambah_jadwal' class="btn btn-success btn-fill btn-sm">Tambah Penjadwalan</a>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <tr><th>ID</th>
                                            <th>Mulai</th>
                                            <th>Berakhir</th>
                                        </tr></thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($query)) { 
                                                
                                            ?>
                                            <tr>
                                                <td><?php echo $row['id_jadwal']; ?></td>
                                                <td><?php echo $row['mulai']; ?></td>
                                                <td><?php echo $row['berakhir']; ?></td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
