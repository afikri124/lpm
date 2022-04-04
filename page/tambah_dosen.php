                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">TAMBAH DATA DOSEN</h4>
                                </div>
                                <div class="card-body">
                                    <form action='action/action_dosen.php' method='POST'>
                                        <div class="row">
                                            <div class="col-md-6 pl-12">
                                                <div class="form-group">
                                                    <label>NIDN</label>
                                                    <input type="text" class="form-control" placeholder="nidn" name='nidn'>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-12">
                                                <div class="form-group">
                                                    <label>KATEGORI</label>
                                                    <select name="kategori" class="form-control">
                                                        <option value="0">Admin</option>
                                                        <option value="1">Auditor</option>
                                                        <option value="2">Dosen</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 px-12">
                                                <div class="form-group">
                                                    <label>NAMA</label>
                                                    <input type="text" class="form-control" placeholder="nama" name='nama_dosen'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 pl-12">
                                                <div class="form-group">
                                                    <label>Fakultas</label>
                                                    <select name="fakultas" class="form-control">
                                                        <option value="Information Sciences and Engineering">Information Sciences and Engineering</option>
                                                        <option value="Economics and Business">Economics and Business</option>
                                                        <option value="Pharmacy">Pharmacy</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5 pl-12">
                                                <div class="form-group">
                                                    <label>JURUSAN</label>
                                                    <select name="jurusan" class="form-control">
                                                        <option value="Information Systems">Bachelor in Information Systems</option>
                                                        <option value="Industrial Engineering">Bachelor in Industrial Engineering</option>
                                                        <option value="Informatics Engineering">Bachelor in Informatics Engineering</option>
                                                        <option value="Mechanical Engineering">Bachelor in Mechanical Engineering</option>
                                                        <option value="Civil Engineering">Bachelor in Civil Engineering</option>
                                                        <option value="Electrical Engineering">Bachelor in Electrical Engineering</option>
                                                        <option value="Masters in Electrical Engineering">Masters in Electrical Engineering</option>
                                                        <option value="Management">Bachelor in Management</option>
                                                        <option value="Digital Business">Bachelor in Digital Business</option>
                                                        <option value="Accounting">Bachelor in Accounting</option>
                                                        <option value="Pharmacy">Bachelor in Pharmacy</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>ALAMAT</label>
                                                    <input type="text" class="form-control" placeholder="alamat" name='alamat'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 px-12">
                                                <div class="form-group">
                                                    <label>USERNAME</label>
                                                    <input type="text" class="form-control" placeholder="username" name='username_dosen'>
                                                </div>
                                            </div>
                                            <div class="col-md-5 px-12">
                                                <div class="form-group">
                                                    <label>PASSWORD</label>
                                                    <input type="text" class="form-control" placeholder="password" name='password_dosen'>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">TAMBAH DATA</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>