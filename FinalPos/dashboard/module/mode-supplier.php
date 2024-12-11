<?php
if(userLogin()['level'] == 3){ //cek user yang sedang aktif
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insert($data){
    global $conn;

    $nama     = mysqli_real_escape_string($conn, $data['nama']);
    $telepon   = mysqli_real_escape_string($conn, $data['telepon']);
    $alamat   = mysqli_real_escape_string($conn, $data['alamat']);
    $ketr     = mysqli_real_escape_string($conn, $data['ketr']);

    $sqlSupplier    = "INSERT INTO tbl_supplier VALUES (NULL,'$nama','$telepon', '$ketr', '$alamat')";

    mysqli_query($conn,$sqlSupplier);

    return mysqli_affected_rows($conn);
}

function delete($id){
    global $conn;

    $sqlDelete = "DELETE FROM tbl_supplier WHERE id_supplier = $id";

    mysqli_query($conn,$sqlDelete);

    return mysqli_affected_rows($conn);
}

?>