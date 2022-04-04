<?php

ob_start();
    session_start();
if($_SESSION['id_user'] == ''){
  echo "<script>alert('Gagal Login'); location.href='login_mhs.php'</script>";
}

    include "../config/config.php";

    if (isset($_POST['simpan']) && $_POST['simpan']) {
    

        $nilai              = $_POST['nilai'];
        $id_kriteria        = $_POST['id_kriteria'];
        $id_dosen           = $_POST['id_dosen'];
        $npm                = $_SESSION['id_user'];

        $sql = '';
        $j = 0;
        foreach ($_POST['nilai'] as $key => $value) {
            

            $sql .= "INSERT INTO data_nilai (id_user, id_dosen, id_kriteria, nilai) VALUES ('$npm', '$id_dosen', '$id_kriteria[$j]', '$value');";
            $j++;
        } 


        if(mysqli_multi_query($con, $sql)) {
            echo "<script>alert('Data Berhasil Tersimpan'); location.href='index.php'</script>";
        }
        else{
            echo "Error" . $sql . "<br>" . mysql_error($con);
        }

    }
?>
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/icon_jgu.jpg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Penilaian Kinerja Dosen</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />

    <link href="../assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/jgu.jpg">
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
                        <a class="nav-link" href="index.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=logout">
                            <i class="nc-icon nc-button-power"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
<?php
    if (isset($_GET['page']) && $_GET['page'] == 'home') {
        include "home.php";
    }
    else if (isset($_GET['page']) && $_GET['page'] == 'nilai_dosen') {
        include "nilai_dosen.php";
    }
    else if (isset($_GET['page']) && $_GET['page'] == 'daftar') {
        include "daftar.php";
    }
    else if (isset($_GET['page']) && $_GET['page'] == 'logout') {
        session_destroy();
        header("Location: login_mhs.php");
    }
    else {
        include "home.php";
    }
    // echo $_SESSION['id_user'];
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
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();