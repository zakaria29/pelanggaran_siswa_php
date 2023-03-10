<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>List Petugas</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="text-white">
                    Daftar Petugas
                </h4>
            </div>

            <div class="card-body">
                <form action="list-petugas.php" method="get">
                    <input type="text" name="search"
                    class="form-control mb-2" placeholder="Pencarian" />
                </form>

                <ul class="list-group">
                    <?php
                    include "connection.php";
                    if (isset($_GET["search"])) {
                        $search = $_GET["search"];
                        $sql = "select * from petugas
                        where nama_petugas like '%$search%'
                        or kontak like '%$search%'
                        or username like '%$search%'";
                    } else {
                        $sql =" select * from petugas";
                    }

                    $hasil = mysqli_query($connect, $sql);
                    while ($petugas = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item mb-2">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h4>
                                        <?=($petugas["nama_petugas"])?>
                                    </h4>

                                    <h6>Kontak: <?=($petugas["kontak"])?></h6>
                                    <h6>Username: <?=($petugas["username"])?></h6>
                                </div>
                                <div class="col-lg-3">
                                    <a href="form-petugas.php?id_petugas=<?=($petugas["id_petugas"])?>">
                                        <button class="btn btn-info btn-block mb-2">
                                            Edit
                                        </button>
                                    </a>

                                    <a href="process-petugas.php?id_petugas=<?=($petugas["id_petugas"])?>"
                                    onclick="return confirm('Are you sure?')">
                                        <button class="btn btn-danger btn-block">
                                            Hapus
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    
                </ul>

                <!-- button tambah data -->
                <a href="form-petugas.php">
                    <button class="btn btn-success">
                        Tambah Data Petugas
                    </button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>