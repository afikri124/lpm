<?php

include "../config/config.php";

ob_start();

session_start();

?>



<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="utf-8" />

  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">

  <link rel="icon" type="image/png" href="../assets/img/icon_jgu.jpg">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>

    Login Dosen

  </title>

  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <!-- CSS Files -->

  <link href="../assets/css/material-kit.css?v=2.0.7" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->

  <link href="../assets/demo/demo.css" rel="stylesheet" />

</head>



<body class="login-page sidebar-collapse">

  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">

    <div class="container">

      <div class="navbar-translate">

        <a class="navbar-brand" href="http://jgu.ac.id">

        JAKARTA GLOBAL UNIVERSITY </a>

      </div>

      <div class="collapse navbar-collapse">

        <ul class="navbar-nav ml-auto">

          <li class="nav-item">

            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://twitter.com/jg_university"  data-original-title="Follow us on Twitter">

              <i class="fa fa-twitter"></i>

            </a>

          </li>

          <li class="nav-item">

            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.facebook.com/jakartaglobaluniversity"  data-original-title="Like us on Facebook">

              <i class="fa fa-facebook-square"></i>

            </a>

          </li>

          <li class="nav-item">

            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.instagram.com/jg_university"  data-original-title="Follow us on Instagram">

              <i class="fa fa-instagram"></i>

            </a>

          </li>

        </ul>

      </div>

    </div>

  </nav>

  <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('../assets/img/red.jpg');">

    <div class="container">

      <div class="row">

        <div class="col-md-8 mx-auto text-center">

          <div class="brand">

            <h3>WELCOME TO THE PAGE</h3>

            <h1>PEER OBSERVATION</h1>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="main main-raised">

    <div class="section">

      <div class="container text-center">

        <div class="row">

          <div class="col-md-8 mx-auto text-center">

            <h3>Peer observation merupakan salah satu kegiatan dalam rangkaian Audit Mutu Internal yang berfungsi untuk menilai bagaimana proses belajar mengajar apakah berlangsung sesuai dengan standar yang ada di Jakarta Global University</h3>

          </div>

        </div>

      </div>

    </div>

    <div class="page-header header-filter" style="background-image: url('../assets/img/jgu.jpg');">

      <div class="container">

        <div class="row">

          <div class="col-lg-4 col-md-6 ml-auto mr-auto">

            <div class="card card-login">

              <form class="form" method='POST'>

                <div class="card-header card-header-primary text-center">

                  <h4 class="card-title">Login Dosen</h4>

                </div>

                <div class="card-body">

                  <div class="input-group">

                    <div class="input-group-prepend">

                      <span class="input-group-text">

                        <i class="material-icons">face</i>

                      </span>

                    </div>

                    <input type="text" class="form-control" placeholder="User Name" name='username_dosen'>

                  </div>

                  <div class="input-group">

                    <div class="input-group-prepend">

                      <span class="input-group-text">

                        <i class="material-icons">lock_outline</i>

                      </span>

                    </div>

                    <input type="password" class="form-control" placeholder="Password..." name='password_dosen'>

                  </div>

                </div>

                <div class="footer text-center">

                  <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg" name="login">LOGIN</button>

                </div>

              </form>



              <?php

              if (isset($_POST['login'])) {

                $username_dosen = $_POST['username_dosen'];

                $password_dosen = md5($_POST['password_dosen']);

                $query = mysqli_query($con, "SELECT * FROM dosen WHERE username_dosen='$username_dosen' AND password_dosen='$password_dosen'");

                $cek = mysqli_num_rows($query);

                if($cek==1) {

                  $dataUser = mysqli_fetch_array($query);

                  $_SESSION['userweb']=$username_dosen;

                  $_SESSION['id_user'] = $dataUser['nidn'];

                  $_SESSION['kategori'] = $dataUser['kategori'];

                  echo "<script>alert('Berhasil Login'); location.href='index.php'</script>";

                }

                else {

                  echo "<script>alert('Maaf username atau password salah. Jika lupa password harap menghubungi email : lpm@jgu.ac.id');</script>";

                }

              }

              ?>

            </div>

          </div>

        </div>

      </div>

      <footer class="footer" data-background-color="black">

        <div class="container">

          <div class="copyright">

            &copy;

            <script>

              document.write(new Date().getFullYear())

            </script>,

            <a href="https://www.instagram.com/m_zhafran24" target="_blank">M_Zhafran24</a>  

          </div>

        </div>

      </footer>

    </div>

  </div>



  <!--   Core JS Files   -->

  <script src="../assets/js/core/jquery.min.js" type="text/javascript"></script>

  <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>

  <script src="../assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>

  <script src="../assets/js/plugins/moment.min.js"></script>

  <!--  Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->

  <script src="../assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->

  <script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

  <!--  Google Maps Plugin    -->

  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->

  <script src="../assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>

</body>



</html>