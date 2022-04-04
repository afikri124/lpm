<?php
include "config/config.php";

$kode_kriteria = $_GET['kode_kriteria'];

$sql = mysqli_query($con, "SELECT * FROM tbl_kriteria WHERE kode_kriteria = '$kode_kriteria'");
$row = mysqli_fetch_array($sql);

?>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">EDIT DATA KRITERIA</h4>
        </div>
        <div class="card-body">
            <form action='action/action_edit_kriteria.php' method='POST'>
                <div class="row">
                    <div class="col-md-3 px-12">
                        <div class="form-group">
                            <label>KATEGORI</label>
                            <select name="kategori" class="form-control">
                                <?php
                                

                                $kategori = array(
                                    '1' => 'Dosen',
                                    '2' => 'Mahasiswa'
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
                    <div class="col-md-3 px-12">
                        <div class="form-group">
                            <label>KODE KRITERIA</label>
                            <input type="text" class="form-control" placeholder="kode kriteria" name='kode_kriteria' value="<?php echo $row['kode_kriteria']?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>KRITERIA</label>
                            <input type="text" class="form-control" placeholder="kriteria" name='kriteria' value="<?php echo $row['kriteria']?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>BOBOT</label>
                            <input type="text" class="form-control" placeholder="bobot" name='bobot' value="<?php echo $row['bobot']?>">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-info btn-fill pull-right">EDIT DATA</button>
                <a href='index.php?page=kriteria' class="btn btn-info life">Kembali </a>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>