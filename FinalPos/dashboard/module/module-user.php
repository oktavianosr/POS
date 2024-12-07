<?php
require "../config/koneksi.php";
function insert($data){
    global $conn;

    $username = strtolower(mysqli_real_escape_string($conn, $data['username']));
    $fullname = mysqli_real_escape_string($conn, $data['fullname']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);
    $level = mysqli_real_escape_string($conn, $data['level']);
    $address = mysqli_real_escape_string($conn, $data['address']);
    $gambar = mysqli_real_escape_string($conn, $_FILES['image']['name']);

    if($password !== $password2){
        echo "<script>
                alert('Password Harus Sesuai!');
        </script>";
        return false;
    }

    $pass = password_hash($password,PASSWORD_DEFAULT);

    $cekUsername = mysqli_query($conn,"SELECT username FROM tbl_user WHERE username = '$username'");

    if(mysqli_num_rows($cekUsername)>0){
        echo "<script>
                    alert('Username Sudah Ada!');
                </script>";
                return false;
    }

    if ($gambar !=null){
        $gambar = uploadimg();
    }else {
        $gambar = 'default.png';
    }

    //gambar tidak sesuai validasi

    if($gambar==''){
        return false;
    }

    $sqlUser = "INSERT INTO tbl_user VALUE (null,'$username','$fullname','$pass','$address','$level','$gambar')";

    mysqli_query($conn, $sqlUser);

    return mysqli_affected_rows(($conn));
}

?>