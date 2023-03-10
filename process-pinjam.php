<?php
include "connection.php";
# menampung data yg dikirim
$kode_pinjam = $_POST["kode_pinjam"];
$tgl_pinjam = $_POST["tgl_pinjam"];
$id_anggota = $_POST["id_anggota"];
$id_petugas = $_POST["id_petugas"];
$buku = $_POST["isbn"]; // array
print_r($buku);

# perintah SQL untuk insert ke table pinjam
$sql = "insert into pinjam values
('$kode_pinjam','$tgl_pinjam',
'$id_anggota','$id_petugas')";

if (mysqli_query($connect, $sql)) {
    # jika berhasil insert ke tbl pinjam
    # insert ke tabel detail_pinjam
    for ($i=0; $i < count($buku); $i++) { 
        $isbn = $buku[$i];
        $sql = "insert into detail_pinjam values
        ('$kode_pinjam','$isbn')";
        if (mysqli_query($connect, $sql)) {
            # jika berhasil insert ke table detail_pinjam
            # yaudah lanjut
        } else {
            # jika gagal insert ke table detail_pinjam
            echo mysqli_error($connect);
            exit;
        }
    }
    header("location:list-pinjam.php");
} else {
    # jika gagal insert ke tbl pinjam
    echo mysqli_error($connect);
}

?>