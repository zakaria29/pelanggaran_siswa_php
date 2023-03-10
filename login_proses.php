<?php
session_start();
include "connection.php";
# session -> tempat penyimpanan data di sisi server
# yg dapat diakses secara global pada halaman web yang
# membutuhkan
if (isset($_POST["login"])) {
    # menampung data username dan password
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);

    # ambil data petugas sesuai username & password
    $sql = "select * from petugas where
    username='$username' and password='$password'";
    $hasil = mysqli_query($connect, $sql);

    # cek hasil query
    # mysqli_num_rows -> cek jumlah baris hasil query
    if (mysqli_num_rows($hasil) > 0) {
        # login berhasil
        # data disimpan ke dalam session
        $petugas = mysqli_fetch_array($hasil);
        $_SESSION["petugas"] = $petugas;
        header("location:list-buku.php");
    } else {
        # login gagal
        header("location:login.php");
    }
}
?>