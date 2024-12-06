<?php
$SERVER="localhost";
$USERNAME="root";
$PASSWORD="";
$DATABASE="point_of_sales";

$conn=mysqli_connect($SERVER,$USERNAME,$PASSWORD,$DATABASE);

if(mysqli_connect_errno()){
    echo "Fail connection to DB";
}

$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
$re_password=$_POST['re_password'];
$no_hp=$_POST['no_hp'];

if($username!="" && $email!="" && $password!="" && $re_password!=""){
    if($password!=$re_password){
        header("location:index.php?pesan='pswd_fail'");
    }else{
        $sql="INSERT INTO user VALUES('','$email','$username','$password','$no_hp')";
        mysqli_query($conn,$sql);
        header("location:../login/index.php?pesan=akun berhasil dibuat");

    }
}else{
    header("location:index.php?pesan='blank'");
}