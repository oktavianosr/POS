<?php


session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location:../login/login.php");
  exit();
}



require "../config/koneksi.php";
require "../config/function.php";
require "../module/mode-user.php";

$id     = $_GET['id'];
$foto     = $_GET['foto'];

if(delete($id, $foto)){
    echo "
    <script>
        alert('User Berhasil Dihapus!');
        document.location.href = 'data-user.php';
    </script>
    ";
}else {
    echo "
    <script>
        alert('User Gagal Dihapus!');
        document.location.href = 'data-user.php';
    </script>
    ";
}
?>