<?php

function update($data){
    global $conn;

    $curPass     = trim(mysqli_real_escape_string($conn, $_POST['curPass'])); //membuang spasi 
    $newPass     = trim(mysqli_real_escape_string($conn, $_POST['newPass']));
    $confPass    = trim(mysqli_real_escape_string($conn, $_POST['confPass']));
    $userActive  = userLogin()['username'];

    if($newPass !== $confPass){
        echo "<script>
                alert('Password Gagal Diperbarui');
                document.location='?msg=err1';
            </script>";
            return false;
    }
    if(!password_verify($curPass, userLogin()['password'])){
        echo "<script>
        alert('Password Tidak Diperbarui');
        document.location='?msg=err2';
    </script>";
    return false;
    }else {
        $pass = password_hash($newPass, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE tbl_user SET password = '$pass' WHERE username = '$userActive' ");
        return mysqli_affected_rows($conn);
    }
}


?>