<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Form Petugas</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-success">
                <h4 class="text-white">Form Petugas</h4>
            </div>

            <div class="card-body">
                <?php 
                if(isset($_GET["id_petugas"])){
                    include "connection.php";
                    $id_petugas = $_GET["id_petugas"];
                    $sql = "select * from petugas
                    where id_petugas='$id_petugas'";

                    $hasil = mysqli_query($connect, $sql);
                    $petugas = mysqli_fetch_array($hasil);
                ?>
                    <form action="process-petugas.php" method="post">
                        ID Petugas
                        <input type="text" name="id_petugas"
                        value="<?=($petugas["id_petugas"])?>"
                        class="form-control mb-2" readonly />

                        Nama Petugas
                        <input type="text" name="nama_petugas"
                        value="<?=($petugas["nama_petugas"])?>"
                        class="form-control mb-2" required />

                        Kontak
                        <input type="text" name="kontak"
                        value="<?=($petugas["kontak"])?>"
                        class="form-control mb-2" required />

                        Username
                        <input type="text" name="username"
                        value="<?=($petugas["username"])?>"
                        class="form-control mb-2" required />

                        Password
                        <input type="password" name="password"
                        class="form-control mb-2" />

                        <button type="submit" name="update_petugas"
                        class="btn btn-success btn-block">
                            Simpan
                        </button>
                    </form>
                <?php 
                }
                else{
                    # insert
                    ?>
                    <form action="process-petugas.php" method="post">
                        
                        Nama Petugas
                        <input type="text" name="nama_petugas"
                        class="form-control mb-2" required />

                        Kontak
                        <input type="text" name="kontak"
                        class="form-control mb-2" required />

                        Username
                        <input type="text" name="username"
                        class="form-control mb-2" required />

                        Password
                        <input type="password" name="password"
                        class="form-control mb-2" required />

                        <button type="submit" name="save_petugas"
                        class="btn btn-success btn-block">
                            Simpan
                        </button>
                    </form>
                <?php 
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>