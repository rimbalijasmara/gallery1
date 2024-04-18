<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Komentar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f9ff;
        }
        .footer {
            position: flex;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #0d6efd;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar .nav-link {
            color: #fff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .table {
            background-color: #fff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fa-solid fa-comment"></i> Halaman Komentar <!-- Ganti class "fas fa-globe" dengan ikon Font Awesome yang Anda inginkan -->
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
                    <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="mt-3">Halaman Komentar</h1>
        <p>Selamat datang <b><?=$_SESSION['namalengkap']?></b></p>
        
        <form action="tambah_komentar.php" method="post">
            <?php
                include "koneksi.php";
                $fotoid=$_GET['fotoid'];
                $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid'");
                while($data=mysqli_fetch_array($sql)){
            ?>
            <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
            <table class="table table-bordered">
                    <tr>
                        <th scope="col">Judul</th>
                        <td><label><?=$data['judulfoto']?></label></td>
                    </tr>
                    <tr>
                        <th scope="col">Deskripsi</th>
                        <td><label><?=$data['deskripsifoto']?></label></td>
                    </tr>
                    <tr>
                        <th scope="col">Foto</th>
                        <td><img src="gambar/<?=$data['lokasifile']?>" width="200px" class="img-fluid rounded"></td>
                    </tr>
                    <tr>
                        <th scope="col">Komentar</th>
                        <td><textarea name="isikomentar" class="form-control"></textarea></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><input type="submit" value="Tambah" class="btn btn-primary"></td>
                    </tr>
            </table>

            <?php
                }
            ?>
        </form>

        <table class="table table-striped table-bordered mt-4">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Komentar</th>
            <th scope="col">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include "koneksi.php";
            $fotoid = $_GET['fotoid']; // Ambil fotoid dari URL

            // Modifikasi kueri SQL dengan menambahkan kondisi WHERE fotoid
            $sql = mysqli_query($conn, "SELECT komentarfoto.*, user.namalengkap FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
            while($data = mysqli_fetch_array($sql)){
        ?>
            <tr>
                <td><?=$data['namalengkap']?></td>
                <td><?=$data['isikomentar']?></td>
                <td><?=$data['tanggalkomentar']?></td>
            </tr>
        <?php
            }
        ?>
    </tbody>
</table>
    </div>
    <?php
    include 'footer.php';
    ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
