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

$title="Update User";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$id     = $_GET['id'];

//query untuk mengambil data berdasarkan id

$sqlEdit = "SELECT * FROM tbl_user WHERE userid = $id";
$user    = getData($sqlEdit)[0];
$level   = $user['level'];

if (isset($_POST['koreksi'])){
    if(update($_POST)){
        echo '  <script>
                    alert("Data User Berhasil Di Update");
                    document.location.href  = "data-user.php";
                </script>';
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
              <li class="breadcrumb-item active">Edit User</li>
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
            <button type="submit" name="koreksi" class="btn btn-primary btn-sm float-right "><i class="fas fa-save"></i> Koreksi</button>
            <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class=""></i> Reset</button>
          </div>
          <div class="card-body">
            <div class="row">
                <input type="hidden" value="<?= $user['userid'] ?>" name="id">
              <div class="col-lg-8 mb-3">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" autofocus autocomplete="off" value="<?= $user['username'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="fullname">Fullname</label>
                  <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukkan Nama Lengkap" value="<?= $user['fullname'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="level">Level</label>
                  <select name="level" id="level" class="form-control">
                    <option value="">-- Level User --</option>
                    <option value="1" <?= selectUser1($level) ?> >Administrator</option>
                    <option value="2"  <?= selectUser3($level) ?> >Supervisor</option>
                    <option value="3"  <?= selectUser2($level) ?> >Operator</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <textarea name="address" id="address" cols="" rows="3" class="form-control" placeholder="Masukka Alamat User" required><?= $user['address'] ?></textarea>
                </div>
              </div>
              <div class="col-lg-4 text-center">
                <input type="hidden" name="oldImg" value="<?= $user['foto'] ?>">
                <img src="<?= $main_url ?>/images/<?= $user['foto'] ?>" class="profile-user-img img-circle mb-3" alt="">
                <input type="file" class="form-control" name="image">
                <span class="text-sm">type File Gambar JPG | PNG | Max Ukuran 1MB</span>
                <br>
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