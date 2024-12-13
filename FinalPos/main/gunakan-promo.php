<?php
session_start();

if (!isset($_SESSION['member_id'])) {
  header("Location: login.php");
}

$conn = mysqli_connect("localhost", "root", "", "point_of_sales");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

$promo_id = $_GET['id'];

$query = "SELECT * FROM promo WHERE id = '$promo_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  // Cek apakah promo masih aktif
  if ($row['promo_start_date'] <= date('Y-m-d') && $row['promo_end_date'] >= date('Y-m-d')) {
    // Cek apakah member telah menggunakan promo sebelumnya
    $query = "SELECT * FROM saldo WHERE member_id = " . $_SESSION['member_id'] . " AND promo_id = '$promo_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
      // Cek apakah saldo member cukup untuk menggunakan promo
      $query = "SELECT * FROM saldo WHERE member_id = " . $_SESSION['member_id'];
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        $saldo_row = mysqli_fetch_assoc($result);

        if ($saldo_row['saldo'] >= $row['promo_discount']) {
          // Update saldo member
          $saldo_baru = $saldo_row['saldo'] - $row['promo_discount'];
          $query = "UPDATE saldo SET saldo = '$saldo_baru' WHERE member_id = " . $_SESSION['member_id'];
          mysqli_query($conn, $query);

          // Tambahkan promo ke saldo member
          $query = "INSERT INTO saldo (member_id, promo_id, saldo) VALUES (" . $_SESSION['member_id'] . ", '$promo_id', '$saldo_baru')";
          mysqli_query($conn, $query);

          echo "Promo berhasil digunakan! Saldo Anda sekarang adalah Rp " . $saldo_baru;
        } else {
          echo "Saldo Anda tidak cukup untuk menggunakan promo";
        }
      } else {
        echo "Anda tidak memiliki saldo";
      }
    } else {
      echo "Anda telah menggunakan promo sebelumnya";
    }
  } else {
    echo "Promo tidak aktif";
  }
} else {
  echo "Promo tidak tersedia";
}

mysqli_close($conn);
?>