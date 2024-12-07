<?php


function uploadimg(){
    $namafile = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $tmp = $_FILES['image']['tmp_name'];

    //validasi file gambar yang boleh di upload

    $ekstensiGambarValid = ['jpg','jpeg','png','gif'];
    $ekstensiGambar =explode('.',$namafile);
    $ekstensiGambar =strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
        echo "<script>
                alert('file yang anda upload bukan gambar, data gagal ditambahkan!');
        </script>";
        return false;
    }

    //validasi ukuran gambar max 1MB

    if($ukuran>1000000){
        echo "<script>
        alert('Ukuran Gambar Tidak Boleh Melebihi 1 MB');
            </script>";
            return false;
    }

    $namaFileBaru=rand(10,1000).'-' . $namafile;

    move_uploaded_file($tmp,'../../images/public' . $namaFileBaru);

    return $namaFileBaru;
}

?>