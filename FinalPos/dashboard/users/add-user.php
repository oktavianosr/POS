<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=point_of_sales', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection error: ' . $e->getMessage()]);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Users</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../assets/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <link rel="shortcut icon" href="../../images/cart.png" type="image/x-icon">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
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
        <ul class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <?= 'Admin' ?><i class="fas fa-user-cog ml-2"></i>
            </a>
            <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item text-right">
                    Ubah Kata Sandi <i class="fas fa-key"></i>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item text-right">
                    Keluar <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>

        </ul>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="../images/team//RealCaffe.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">RealCaffe</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= 'Kasir1' ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt text-sm"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder text-sm"></i>
                    <p>
                        Master
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon text-sm"></i>
                            <p>Pemasok</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon text-sm"></i>
                            <p>Customer</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon text-sm"></i>
                            <p>Barang</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-header">Transaksi</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-shopping-cart text-sm"></i>
                    <p>Pembelian</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-file-invoice text-sm"></i>
                    <p>Penjualan</p>
                </a>
            </li>
            
            <li class="nav-header">Laporan</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie text-sm"></i>
                    <p>Laporan Pembelian</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-file-invoice text-sm"></i>
                    <p>Laporan Penjualan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-warehouse text-sm"></i>
                    <p>Laporan Stock</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder text-sm"></i>
                    <p>
                        Pengaturan
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon text-sm"></i>
                            <p>Users</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="users/data-user.php">Users</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-tittle"><i class="fas fa-plus fa-sm"></i> Add User</h3>
            <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right "><i class="fas fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class=""></i> Reset</button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-8 mb-3">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" autofocus autocomplete="off" require>
                </div>
                <div class="form-group">
                  <label for="fullname">Fullname</label>
                  <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukkan Nama Lengkap" require>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password" require>
                </div>
                <div class="form-group">
                  <label for="password2">Konfirmasi Password</label>
                  <input type="password" name="password2" class="form-control" id="password2" placeholder="Masukkan Kembali Password Anda" require>
                </div>
                <div class="form-group">
                  <label for="level">Level</label>
                  <select name="level" id="level" class="form-control">
                    <option value="">-- Level User --</option>
                    <option value="1">-- Level Administrator --</option>
                    <option value="2">-- Level Supervisor --</option>
                    <option value="3">-- Level Operator --</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <textarea name="address" id="address" cols="" rows="3" class="form-control" placeholder="Masukka Alamat User" required></textarea>
                </div>
              </div>
              <div class="col-lg-4 text-center">
                <img src="../../images/default.png" class="profile-user-img img-circle mb-3" alt="">
                <input type="file" class="form-control" name="image">
                <span class="text-sm">type File Gambar JPG | PNG | GIF</span>
                <span class="text-sm">Widht = Height</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

          </div>
          <!-- ./col -->
  </div>
    <!-- /.content -->
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <span class="text-info">Okta Tech</span></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../assets/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../assets/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="../../assets/AdminLTE-3.2.0/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../../assets/AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>
</body>
</html>
