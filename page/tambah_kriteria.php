                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">TAMBAH DATA KRITERIA</h4>
                                </div>
                                <div class="card-body">
                                    <form action='action/action_kriteria.php' method='POST'>
                                        <div class="row">
                                            <div class="col-md-3 px-12">
                                                <div class="form-group">
                                                    <label>KATEGORI</label>
                                                    <select name="kategori" class="form-control">
                                                        <option value="1">Dosen</option>
                                                        <option value="2">Mahasiswa</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-12">
                                                <div class="form-group">
                                                    <label>KODE KRITERIA</label>
                                                    <input type="text" class="form-control" placeholder="P = dosen, K = mahasiwa" name='kode_kriteria'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>KRITERIA</label>
                                                    <input type="text" class="form-control" placeholder="kriteria" name='kriteria'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>BOBOT</label>
                                                    <input type="text" class="form-control" placeholder="bobot" name='bobot'>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">TAMBAH DATA</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>