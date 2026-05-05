<?php
session_start();
require_once("config/koneksi.php");

if(!isset($_SESSION['username'])){
    echo "<meta http-equiv='refresh' content='0; url=login.php'>";
    exit;
}

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
$username = $_SESSION['username'];

// Handle page parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - <?php echo ucfirst($role); ?></title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> 
          <span><?php echo ucfirst($username); ?></span>
          <span class="badge badge-<?php echo $role == 'admin' ? 'primary' : ($role == 'guru' ? 'success' : 'info'); ?>">
            <?php echo strtoupper($role); ?>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo ucfirst($role); ?> Panel</span>
          <div class="dropdown-divider"></div>
          <a href="index.php?page=profil" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Profil
          </a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">School Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo ucfirst($username); ?></a>
          <span class="badge badge-<?php echo $role == 'admin' ? 'primary' : ($role == 'guru' ? 'success' : 'info'); ?>">
            <?php echo ucfirst($role); ?>
          </span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Dashboard -->
          <li class="nav-item">
            <a href="index.php?page=dashboard" class="nav-link <?php echo $page=='dashboard' ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <?php if($role == 'admin'): ?>
          <!-- Admin Menu -->
          <li class="nav-header">MANAJEMEN DATA</li>
          
          <li class="nav-item has-treeview <?php echo (strpos($page, 'guru') !== false || strpos($page, 'siswa') !== false || strpos($page, 'kelas') !== false || strpos($page, 'mapel') !== false) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo (strpos($page, 'guru') !== false || strpos($page, 'siswa') !== false || strpos($page, 'kelas') !== false || strpos($page, 'mapel') !== false) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=guru" class="nav-link <?php echo $page=='guru' ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=siswa" class="nav-link <?php echo $page=='siswa' ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=kelas" class="nav-link <?php echo $page=='kelas' ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=mapel" class="nav-link <?php echo strpos($page, 'mapel') !== false ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mata Pelajaran</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Transaksi -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=jadwal" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Pelajaran</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Ekstrakulikuler
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=ekstra_2511500058" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ekstrakulikuler</p>
                </a>
              </li>
            </ul>
          </li>

          <?php elseif($role == 'guru'): ?>
          <!-- Guru Menu -->
          <li class="nav-header">MANAJEMEN GURU</li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Kelas & Jadwal
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=kelas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas Saya</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=?" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Saya</p>
                </a>
              </li>
            </ul>
          </li>

          <?php elseif($role == 'siswa'): ?>
          <!-- Siswa Menu -->
          <li class="nav-header">MANAJEMEN SISWA</li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Data Pribadi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=kelas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profil Saya</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Jadwal & Nilai
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=?" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Saya</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=?" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Raport Nilai</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>

          <!-- Logout -->
          <li class="nav-item mt-4 border-top pt-2">
            <a href="logout.php" class="nav-link text-danger">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p><strong>Keluar</strong></p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php 
            if($page == 'dashboard') {
                echo '<h1 class="m-0 text-primary">Dashboard</h1>';
            } elseif(strpos($page, 'mapel') !== false) {
                echo '<h1 class="m-0">Mata Pelajaran</h1>';
            } else {
                echo '<h1 class="m-0">' . ucwords(str_replace('_', ' ', $page)) . '</h1>';
            }
            ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active"><?php echo ucwords(str_replace('_', ' ', $page)); ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php 
        // Load page content
        if (isset($_GET['page'])) {
            $page_file = "page/" . $_GET['page'] . ".php";
            if (file_exists($page_file)) {
                include $page_file;
            } else {
                echo '
                <div class="alert alert-warning alert-dismissible">
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Halaman Tidak Ditemukan!</h5>
                    Halaman <strong>' . htmlspecialchars($_GET['page']) . '</strong> tidak tersedia.
                </div>';
                include "page/dashboard.php";
            }
        } else {
            include "page/dashboard.php";
        }
        ?>
      </div>
    </section>
  </div>

  <!-- Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="#">School Management System</a>.</strong>
    All rights reserved. | Version 2.0
    <div class="float-right d-none d-sm-inline-block">
      <b><?php echo ucfirst($role); ?></b> Panel
    </div>
  </footer>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTables
    $('.table-datatable').DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "emptyTable": "Tidak ada data tersedia",
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        }
    });
});
</script>
</body>
</html>