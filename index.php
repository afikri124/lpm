<?php
ob_start();
session_start();

if($_SESSION['id_user'] == ''){
  echo "<script>alert('Gagal Login'); location.href='login.php'</script>";
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/icon_jgu.jpg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.1 " rel="stylesheet" />

    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/jgu.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://jgu.ac.id" class="simple-text">
                JAKARTA GLOBAL UNIVERSITY
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=dashboard">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=dosen">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>Menu Dosen</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=mahasiswa">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>Menu Mahasiswa</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=kriteria">
                    <i class="nc-icon nc-notes"></i>
                    <p>Kriteria</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=penugasan">
                    <i class="nc-icon nc-notes"></i>
                    <p>Penugasan</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=penilaian_mhs">
                    <i class="nc-icon nc-ruler-pencil"></i>
                    <p>Penilaian Mahasiswa</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=penilaian_auditor">
                    <i class="nc-icon nc-ruler-pencil"></i>
                    <p>Penilaian Auditor</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=rekap">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>Rekap Data Penilai</p>
                </a>
            </li> 
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=hasil">
                    <i class="nc-icon nc-chart-bar-32"></i>
                    <p>Hasil Metode MAUT</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=jadwal">
                    <i class="nc-icon nc-sun-fog-29"></i>
                    <p>Penjadwalan</p>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-end" id="navigation">        
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php echo $_SESSION['id_user'] ?></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php">Home</a></li>
                            <li><a href=index.php?page=logout>Logout</a></li>
                        </ul>
                    </li>          
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $halaman = '';
                    if(isset($_GET['page']) && $_GET['page'] == 'mahasiswa'){
                        $halaman = 'mahasiswa.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'dashboard'){
                        $halaman = 'dashboard.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'dosen'){
                        $halaman = 'dosen.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'kriteria'){
                        $halaman = 'kriteria.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'penugasan'){
                        $halaman = 'penugasan.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'tambah_dosen'){
                        $halaman = 'tambah_dosen.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'tambah_mahasiswa'){
                        $halaman = 'tambah_mahasiswa.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'tambah_kriteria'){
                        $halaman = 'tambah_kriteria.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'tambah_penugasan'){
                        $halaman = 'tambah_penugasan.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'data_penugasan'){
                        $halaman = 'data_penugasan.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'edit_mahasiswa'){
                        $halaman = 'edit_msh.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'edit_dosen'){
                        $halaman = 'edit_dosen.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'edit_kriteria'){
                        $halaman = 'edit_kriteria.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'penilaian_mhs'){
                        $halaman = 'penilaian_mhs.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'penilaian_auditor'){
                        $halaman = 'penilaian_auditor.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'rekap'){
                        $halaman = 'rekap.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'rekap_mhs'){
                        $halaman = 'rekap_mhs.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'hasil'){
                        $halaman = 'hasil.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'jadwal'){
                        $halaman = 'jadwal.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'tambah_jadwal'){
                        $halaman = 'tambah_jadwal.php';
                    }
                    else if(isset($_GET['page']) && $_GET['page'] == 'logout' ){
                        session_destroy();
                        header("Location: login.php");
                    }
                    else{
                        $halaman = 'dashboard.php';
                    }

                    include "page/".$halaman;
                    ?>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav>
                    <p class="copyright text-center">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        <a href="https://www.instagram.com/m_zhafran24" target="_blank">M_Zhafran24</a>   
                    </p>
                </nav>
            </div>
        </footer>
    </div>
</div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();


    });
</script>

</html>
