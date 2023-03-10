<?php
include "connection.php";

if (isset($_POST["save_petugas"])) {
    # insert data petugas
    $nama_petugas = $_POST["nama_petugas"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);

    $sql = "insert into petugas values
    ('','$nama_petugas','$kontak','$username','$password')";

    if (mysqli_query($connect, $sql)) {
        header("location:list-petugas.php");
    }else{
        echo mysqli_error($connect);
    }
}

else if(isset($_POST["update_petugas"])){
    # edit/update petugas
    $id_petugas = $_POST["id_petugas"];
    $nama_petugas = $_POST["nama_petugas"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    
    if (empty($_POST["password"])) {
        # password tidak ikut teredit
        $sql = "update petugas set
        nama_petugas='$nama_petugas',
        kontak='$kontak',username='$username'
        where id_petugas='$id_petugas'";
    } else {
        # password ikut teredit
        $password = sha1($_POST["password"]);
        $sql = "update petugas set
        nama_petugas='$nama_petugas',
        kontak='$kontak',username='$username',
        password='$password'
        where id_petugas='$id_petugas'";
    }

    if (mysqli_query($connect, $sql)) {
        header("location:list-petugas.php");
    }else{
        echo mysqli_error($connect);
    }
}
?>