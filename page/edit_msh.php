<?php
    include "config/config.php";

    $npm = $_GET['npm'];

    $sql = mysqli_query($con, "SELECT * FROM mahasiswa WHERE npm = '$npm'");
    $row = mysqli_fetch_array($sql);

?>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">EDIT DATA MAHASISWA</h4>
                                </div>
                                <div class="card-body">
                                    <form action='action/action_edit_msh.php' method='POST'>
                                        <div class="row">
                                            <div class="col-md-4 px-12">
                                                <div class="form-group">
                                                    <label>NPM</label>
                                                    <input type="text" class="form-control" placeholder="npm" name='npm' value="<?php echo $row['npm']?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-12">
                                                <div class="form-group">
                                                    <label>NAMA</label>
                                                    <input type="text" class="form-control" placeholder="nama" name='nama_mhs' value="<?php echo $row['nama_mhs']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pl-12">
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
                                            <div class="col-md-4 pl-12">
                                                <div class="form-group">
                                                    <label>KELAS</label>
                                                     <input type="text" class="form-control" placeholder="kelas" name='kelas' value="<?php echo $row['kelas']?>">
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
                                                    <input type="text" class="form-control" placeholder="username" name='username_mhs' value="<?php echo $row['username_mhs']?>">
                                                </div>
                                            </div>
                                            <div class="col-md-5 px-12">
                                                <div class="form-group">
                                                    <label>PASSWORD</label>
                                                    <input type="text" class="form-control" placeholder="password" name='password_mhs'>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info btn-fill pull-right">EDIT DATA</button>
                                        <a href='index.php?page=mahasiswa' class="btn btn-info life">Kembali </a>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>