<?php
    include "config/config.php";

    $nidn = $_GET['nidn'];

    $sql = mysqli_query($con, "SELECT * FROM dosen WHERE nidn = '$nidn'");
    $row = mysqli_fetch_array($sql);

?>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">EDIT DATA DOSEN</h4>
                                </div>
                                <div class="card-body">
                                    <form action='action/action_edit_dosen.php' method='POST'>
                                        <div class="row">
                                            <div class="col-md-6 px-12">
                                                <div class="form-group">
                                                    <label>NIDN</label>
                                                    <input type="text" class="form-control" placeholder="nidn" name='nidn' value="<?php echo $row['nidn']?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-12">
                                                <div class="form-group">
                                                    <label>KATEGORI</label>
                                                    <select name="kategori" class="form-control">
                                                        <?php
                                                            

                                                            $kategori = array(
                                                                            '0' => 'Admin',
                                                                            '1' => 'Auditor',
                                                                            '2' => 'Dosen'
                                                                        );
                                                            foreach ($kategori as $ktg => $k) {
                                                                $selected = '';
                                                                if ($row['kategori'] == $ktg) {
                                                                    $selected = 'selected';
                                                                }
                                                        ?>
                                                        <option value="<?php echo $ktg; ?>" <?php echo $selected; ?>><?php echo $k; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 px-12">
                                                <div class="form-group">
                                                    <label>NAMA</label>
                                                    <input type="text" class="form-control" placeholder="nama" name='nama_dosen' value="<?php echo $row['nama_dosen']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 pl-12">
                                                <div class="form-group">
                                                    <label>FAKULTAS</label>
                                                    <select name="fakultas" class="form-control">
                                                        <?php

                                                            $fakultas = array(
                                                                            'Information Sciences and Engineering' => 'Information Sciences and Engineering',
                                                                            'Economics and Business' => 'Economics and Business',
                                                                            'Pharmacy' => 'Pharmacy'
                                                                        );
                                                            foreach ($fakultas as $ktg => $k) {
                                                                $selected = '';
                                                                if ($row['fakultas'] == $ktg) {
                                                                    $selected = 'selected';
                                                                }
                                                        ?>
                                                        <option value="<?php echo $ktg; ?>" <?php echo $selected; ?>><?php echo $k; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>       
                                            <div class="col-md-5 pl-12">
                                                <div class="form-group">
                                                    <label>JURUSAN</label>
                                                    <select name="jurusan" class="form-control">
                                                        <?php
                                                            

                                                            $jurusan = array(
                                                                            'Information Systems' => 'Bachelor in Information Systems',
                                                                            'Industrial Engineering' => 'Bachelor in Industrial Engineering',
                                                                            'Informatics Engineering' => 'Bachelor in Informatics Engineering',
                                                                            'Mechanical Engineering' => 'Bachelor in Mechanical Engineering',
                                                                            'Civil Engineering' => 'Bachelor in Civil Engineering',
                                                                            'Electrical Engineering' => 'Bachelor in Electrical Engineering',
                                                                            'Masters in Electrical Engineering' => 'Masters in Electrical Engineering',
                                                                            'Management' => 'Bachelor in Management',
                                                                            'Digital Business' => 'Bachelor in Digital Business',
                                                                            'Accounting' => 'Bachelor in Accounting',
                                                                            'Pharmacy' => 'Bachelor in Pharmacy'
                                                                        );
                                                            foreach ($jurusan as $ktg => $k) {
                                                                $selected = '';
                                                                if ($row['jurusan'] == $ktg) {
                                                                    $selected = 'selected';
                                                                }
                                                        ?>
                                                        <option value="<?php echo $ktg; ?>" <?php echo $selected; ?>><?php echo $k; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>                               
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>ALAMAT</label>
                                                    <input type="text" class="form-control" placeholder="alamat" name='alamat' value="<?php echo $row['alamat']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 px-12">
                                                <div class="form-group">
                                                    <label>USERNAME</label>
                                                    <input type="text" class="form-control" placeholder="username" name='username_dosen' value="<?php echo $row['username_dosen']?>">
                                                </div>
                                            </div>
                                            <div class="col-md-5 px-12">
                                                <div class="form-group">
                                                    <label>PASSWORD</label>
                                                    <input type="text" class="form-control" placeholder="password" name='password_dosen'>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info btn-fill pull-right">EDIT DATA</button>
                                        <a href='index.php?page=dosen' class="btn btn-info life">Kembali </a>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>