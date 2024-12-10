<?php
session_start();

require "../dashboard/config/koneksi.php";

if(isset($_POST['submit'])){
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $queryLogin = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username='$username'");

  if(mysqli_num_rows($queryLogin)===1){
    $row = mysqli_fetch_assoc($queryLogin);
    if(password_verify($password,$row['password'])){
      header("location:../dashboard");
      exit();
    }else{
      echo "<script>
              alert('password salah');
            </script>";
              }
  }else{
    echo "<script>
    alert('username tidak terdaftar');
  </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Masuk & Buat Akun</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="hold-transition login-page" id="bg-login">
    <div class="container-signup" id="signup" style="display:none;">
      <h1 class="form-title">Sign Up</h1>
      <form method="post" action="../signup/auth.php">
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="email">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="username" id="user" placeholder="Username" required>
            <label for="user">Username</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="password" name="re_password" id="re_password" placeholder="Re Password" required>
            <label for="re_password">Re Password</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="text" name="no_hp" id="no_hp" placeholder="No.hp" required>
            <label for="no_hp">No.hp</label>
        </div>
        <button class="btn" id="signUp" name="signUp"></button>
      </form>
      <p class="or">
      </p>
      <div class="links">
        <p>Sudah Memiliki Akun ?</p>
        <button id="signInButton" style="cursor:pointer;">Masuk</button>
      </div>
    </div>

    <div class="container  slide-down" id="signIn">
        <h1 class="form-title">Login</h1>
        <form method="POST" action="">
          <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="text" name="username" id="username" placeholder="Username" required>
              <label for="username">Username</label>
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="pswd" placeholder="Password" required>
              <label for="pswd">Password</label>
          </div>
          <!-- <p class="recover">
            <a href="#">Recover Password</a>
          </p> -->
          <button class="btn" name="submit">Masuk</button>
        </form>
        <div class="links">
          <p>Belum Memiliki Akun?</p>
          <button id="signUpButton" style="cursor:pointer;">Buat Akun</button>
        </div>
        <div class="links">
          <p><a href="../index.php">Kembali Ke Halaman Utama</a></p>
        </div>
      </div>
      <script src="script.js"></script>
</body>
</html>