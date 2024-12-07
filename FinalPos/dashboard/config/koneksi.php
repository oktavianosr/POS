<?php
$conn = mysqli_connect("localhost", "root", "", "point_of_sales");

// Periksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

$main_url='http://localhost/POS/FinalPos/';
?>