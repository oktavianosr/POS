<?php
require "../config/koneksi.php";
require "../config/function.php";
require "../module/mode-user.php";

$title = "Users - Dashboard";
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
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Data User</h3>
                    <div class="card-tools">
                        <a href="<?= $main_url ?>/dashboard/users/add-user.php" class="btn btn-sm btn-primary"><i class="fas fa-plus fa-sm"></i> Add User</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Alamat</th>
                                <th>Level User</th>
                                <th class="width:10%;">Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            $users = getData("SELECT * FROM tbl_user");
                            foreach($users as $user): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><img src="../../assets/image<?= $user['foto'] ?>"
                                class="rounded-circle" alt="" width="60px"></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['fullname'] ?></td>
                                <td><?= $user['address'] ?></td>
                                <td><?= $user['level'] ?></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning" title="edit user"><i class="fas fa-edit"></i></a>
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