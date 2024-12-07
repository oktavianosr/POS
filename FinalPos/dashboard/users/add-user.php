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

require "../config/function.php";
require "../config/koneksi.php";
require "../module/mode-user.php";

$title="Add User";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";
if(isset($_POST['simpan'])){
  if(insert($_POST)>0){
    echo '<script>
                alert("User Baru Berhasil Di Registrasi");
                window.location.href="add-user.php";
          </script>';
          exit;
  }
}

?>

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
              <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
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
          <form action="" method="post" enctype="multipart/form-data">
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
                <img src="<?= $main_url ?>/images/default.png" class="profile-user-img img-circle mb-3" alt="">
                <input type="file" class="form-control" name="image">
                <span class="text-sm">type File Gambar JPG | PNG | GIF</span>
                <span class="text-sm">Widht = Height</span>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
    </section>
  </div>
  <?php
  require "../template/footer.php";
  ?>