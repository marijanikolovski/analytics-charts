<?php
session_start();

include('db.php');

$sqlDevices = "SELECT id, name FROM devices";
$devices = fetch($sqlDevices, $connection, true);

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bootstrap Material Admin by Bootstrapious.com</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  <!-- Choices CSS-->
  <link rel="stylesheet" href="vendor/choices.js/public/assets/styles/choices.min.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/favicon.ico">
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
  <div class="page">
    <!-- Main Navbar-->
    <header class="header z-index-50">
      <nav class="nav navbar py-3 px-0 shadow-sm text-white position-relative">
        <div class="container-fluid w-100">
          <div class="navbar-holder d-flex align-items-center justify-content-between w-100">
            <!-- Navbar Header-->
            <div class="navbar-header">
              <!-- Navbar Brand --><a class="navbar-brand d-none d-sm-inline-block" href="index.html">
                <div class="brand-text d-none d-lg-inline-block"><span>Bootstrap </span><strong>Dashboard</strong></div>
                <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div>
              </a>
              <!-- Toggle Button--><a class="menu-btn active" id="toggle-btn" href="#"><span></span><span></span><span></span></a>
            </div>
            <!-- Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <!-- Search-->
              <li class="nav-item d-flex align-items-center"><a id="search" href="#">
                  <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                    <use xlink:href="#find-1"> </use>
                  </svg></a></li>
              <!-- User name -->
              <li class="nav-item"><?php echo $_SESSION["user_name"]; ?></li>
              <!-- Logout    -->
              <li class="nav-item"><a class="nav-link text-white" href="logout.php"> <span class="d-none d-sm-inline">Logout</span>
                  <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                    <use xlink:href="#security-1"> </use>
                  </svg></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div class="page-content d-flex align-items-stretch">
      <!-- Side Navbar -->
      <nav class="side-navbar z-index-40">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center py-4 px-3"><img class="avatar shadow-0 img-fluid rounded-circle" src="img/avatar-3.jpg" alt="...">
          <div class="ms-3 title">
            <h1 class="h4 mb-2"></h1>
            <p class="text-sm text-gray-500 fw-light mb-0 lh-1">Web Designer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Marija Nikolovski</span>
        <ul class="list-unstyled py-4">
          <li class="sidebar-item active"><a class="sidebar-link" href="index.php">
              <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                <use xlink:href="#real-estate-1"> </use>
              </svg>Home </a></li>
          <li class="sidebar-item"><a class="sidebar-link" href="login.php">
              <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                <use xlink:href="#disable-1"> </use>
              </svg>Login page </a>
          </li>
          <li class="sidebar-item"><a class="sidebar-link" href="register.php">
              <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                <use xlink:href="#disable-1"> </use>
              </svg>Register </a>
          </li>
        </ul>
      </nav>
      <div class="content-inner w-100">
        <!-- Page Header-->
        <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
            <h2 class="mb-0 p-1">Dashboard</h2>
          </div>
        </header>
        <!-- Dashboard Counts Section-->
        <div class="container-fluid">
          <div class="card mb-0">
            <div class="card-body">
              <div class="row gx-5 bg-white">
                <h1>Select a Device</h1>
                <form id="deviceForm" method="post">
                  <label for="device">Select a device:</label>
                  <select name="device" id="device">
                    <?php
                    foreach ($devices as $device) {
                      echo "<option  value=\"" . $device["id"] . "\">" . $device["name"] . "</option>";
                    }
                    ?>
                    <input type="submit" value="Show Latest Sensor Data">
                </form>
                <div id="latestData"></div>
              </div>
            </div>
          </div>
        </div>
        </section>
        <!-- Charts    -->
        <div>
          <div class="sensorChartHumidity">
            <canvas width="200" height="70" id="sensorChart1"></canvas>
            <button id="btnHumidity" style="display: none;" onclick="exportToCSV('sensorChart1')">Export Humidity sensor Data</button>
          </div>
          <div class="sensorChartPh">
            <canvas width="200" height="70" id="sensorChart2"></canvas>
            <button id="btnPh" style="display: none;" onclick="exportToCSV('sensorChart2')">Export Ph sensor Data</button>
          </div>
        </div>
        <!-- Page Footer-->
        <footer class="position-absolute bottom-0 bg-darkBlue text-white text-center py-3 w-100 text-xs" id="footer">
          <div class="container-fluid">
            <div class="row gy-2">
              <div class="col-sm-6 text-sm-start">
                <p class="mb-0">Your company &copy; 2017-2022</p>
              </div>
              <div class="col-sm-6 text-sm-end">
                <p class="mb-0">Design by <a href="#" class="text-white text-decoration-none">Marija</a></p>
                <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <!-- JavaScript files-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script type="module" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
  <script src="/js/get-sensor.js"></script>
  <script src="/js/exportToCSV.js"></script>
</body>

</html>