<?php
session_start();

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'point_of_sales');

// Cek apakah member sudah login
if (isset($_SESSION['member_id'])) {
    // Query untuk memeriksa apakah member sudah memiliki promo
    $sql = "SELECT * FROM promo WHERE member_id = '".$_SESSION['member_id']."'";
    $result = $conn->query($sql);

    // Cek apakah member sudah memiliki promo
    if ($result->num_rows > 0) {
        // Tampilkan pesan error jika member sudah memiliki promo
        echo 'Anda sudah memiliki promo';
    } else {
        // Query untuk membuat promo baru
        $sql = "INSERT INTO promo (member_id, promo_code) VALUES ('".$_SESSION['member_id']."', 'PROMO".$_SESSION['member_id']."')";
        $conn->query($sql);

        // Tampilkan promo code
        echo 'Promo code Anda: PROMO'.$_SESSION['member_id'];
    }
} else {
    // Redirect ke halaman login jika member belum login
    header('Location: login.php');
    exit;
}