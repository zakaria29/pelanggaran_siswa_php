<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Daftar Peminjaman</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white">
                    Daftar Peminjaman
                </h4>
            </div>

            <div class="card-body">
                <ul class="list-group">
                    <?php
                    include "connection.php";
                    $sql = "select 
                    pinjam.*,anggota.*,petugas.*,
                    pengembalian.id_pengembalian,pengembalian.tgl_kembali,
                    pengembalian.denda
                    from
                    pinjam inner join anggota
                    on anggota.id_anggota=pinjam.id_anggota
                    inner join petugas
                    on pinjam.id_petugas=petugas.id_petugas
                    left outer join pengembalian
                    on pinjam.kode_pinjam=pengembalian.kode_pinjam";

                    $hasil = mysqli_query($connect, $sql);
                    while ($pinjam = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Kode Pinjam</small>
                                    <h5><?=($pinjam["kode_pinjam"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Peminjam</small>
                                    <h5><?=($pinjam["nama_anggota"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Petugas</small>
                                    <h5><?=($pinjam["nama_petugas"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Tgl. Pinjam</small>
                                    <h5><?=($pinjam["tgl_pinjam"])?></h5>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <h6>
                                        Status:
                                        <?php if($pinjam["id_pengembalian"] == null) {?>
                                            <div class="badge badge-warning">
                                                Masih Dipinjam
                                            </div>
                                            <a href="proses-kembali.php?
                                            kode_pinjam=<?=($pinjam["kode_pinjam"])?>"
                                            onclick="return confirm('Kamu yakin ingin kembali?')">
                                            <button class="btn btn-sm btn-success mx-2">
                                                Dikembalikan
                                            </button>
                                            </a>
                                        <?php } else {?>
                                            <div class="badge badge-success">
                                                Sudah dikembalikan
                                            </div>
                                            <div class="badge badge-info">
                                                Denda: Rp <?=(number_format($pinjam["denda"],2))?>
                                            </div>
                                        <?php } ?>
                                    </h6>
                                </div>
                            </div>
                            
                            <small class="text-success">
                                <u>List Buku yang dipinjam</u>
                            </small>
                            <ul>
                            <?php
                            $kode_pinjam = $pinjam["kode_pinjam"];
                            $sql = "select * from detail_pinjam
                            inner join buku
                            on detail_pinjam.isbn = buku.isbn
                            where kode_pinjam = '$kode_pinjam'";

                            $hasil_buku = mysqli_query($connect, $sql);
                            while ($buku = mysqli_fetch_array($hasil_buku)) {
                                ?>
                                <li>
                                    <small>
                                        <?=($buku["judul_buku"])?>

                                        <i class="text-primary">
                                            (Ditulis oleh <?=($buku["penulis"])?>)
                                        </i>
                                    </small>
                                </li>
                                <?php
                            }
                            ?>
                            </ul>
                            
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>     
        </div>
    </div>
</body>
</html>