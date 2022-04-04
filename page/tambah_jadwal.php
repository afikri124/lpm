                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">TAMBAH PENJADWALAN</h4>
                                </div>
                                <div class="card-body">
                                    <form action='action/action_jadwal.php' method='POST'>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>MULAI</label>
                                                    <input type="date" class="form-control" name='mulai'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>BERAKHIR</label>
                                                    <input type="date" class="form-control" name='berakhir'>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">TAMBAH DATA</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>