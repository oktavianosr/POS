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
// require "../module/mode-supplier.php";

$title="Add Supplier - User";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Supplier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard/users/data-supplier">Supplier</a></li>
              <li class="breadcrumb-item active">Add Supplier</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <form action="" method="post">
                <div class="card-header row">
                    <div class="col-6">
                        <h3 class="card-tittle"><i class="fas fa-plus fa-sm"></i> Add Supplier</h3>
                    </div>
                    <div class="col-6 text-right">
                        <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right "><i class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class=""></i> Reset</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 mb-3">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="nama supplier" autofocus autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon" class="form-control" id="telepon" placeholder="no telepon supplier" pattern="[0-9]{5,}" autofocus title="minimal 5 angka"  required>
                            </div>
                            <div class="form-group">
                                <label for="ketr">Deskripsi</label>
                                <textarea name="ketr" id="ketr" rows="1" class="form-control" placeholder="keterangan supplier" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="alamat supplier" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </section>


<?php
require "../template/footer.php";

?>