<?php
session_start();

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'point_of_sales');

// Cek apakah form login telah diisi
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah username dan password benar
    $sql = "SELECT * FROM member WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Cek apakah data member ditemukan
    if ($result->num_rows > 0) {
        // Simpan data member ke dalam session
        $_SESSION['member_id'] = $result->fetch_assoc()['id'];
        $_SESSION['member_name'] = $result->fetch_assoc()['name'];

        // Redirect ke halaman utama
        header('Location:index.php');
        exit;
    } else {
        // Tampilkan pesan error jika username atau password salah
        echo 'Username atau password salah';
    }
}

// Tampilkan form login
?>
<form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>