<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location:../../login/login.php");
  exit();
}

require "../config/function.php";
require "../config/koneksi.php";
require "../module/mode-supplier.php";

$title="Data Supplier ";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if(isset($_GET['msg'])){
  $msg = $_GET['msg'];
}else {
  $msg = '';
}

$alert='';

if($msg == 'deleted'){
  $alert = '<div class="alert alert-success               alert-dismissible">   
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Supplier Berhasil Dihapus
                </div>';
}

if($msg == 'aborted'){
  $alert = '<div class="alert alert-danger               alert-dismissible">   
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                  Supplier Gagal Dihapus
                </div>';
}


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
              <li class="breadcrumb-item active">Data Supplier</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    
    <section>
        <div class="container-fluid">
            <div class="card">
              <?php if($alert !=''){
                echo $alert;
              } ?>
                <div class="card-header">
                        <h3 class="card-tittle"><i class="fas fa-list fa-sm"></i> Data Supplier</h3>
                        <a href="<?= $main_url ?>dashboardsupplier/add-supplier.php" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus fa-sm"></i> Add Supplier</a>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Deskripsi</th>
                                <th style="width: 10%;">Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $suppliers = getData("SELECT * FROM tbl_supplier");
                            foreach($suppliers as $supplier):
                            ?>
                                <tr>
                                    <td> <?= $no++ ?> </td>
                                    <td> <?= $supplier['nama'] ?> </td>
                                    <td> <?= $supplier['telepon'] ?> </td>
                                    <td> <?= $supplier['alamat'] ?> </td>
                                    <td> <?= $supplier['deskripsi'] ?> </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-warning" title="edit supplier"><i class="fas fa-pen"> </i></a>
                                        <a href="del-supplier.php?id=<?= $supplier['id_supplier'] ?>" class="btn btn-sm btn-danger" title="hapus supplier" onclick="return confirm('Anda Yakin Akan Menghapus Supplier Ini?')"><i class="fas fa-trash"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>



<?php
require "../template/footer.php";
?>