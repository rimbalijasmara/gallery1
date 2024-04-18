<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Edit Album</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <style>
        body {
            background-color: #f0f9ff;
            padding: 20px;
        }
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #0d6efd;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            color: #007bff;
        }

        ul.navbar-nav li.nav-item a.nav-link {
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        input[type="text"],
        input[type="submit"] {
            width: 100%;
            margin-bottom: 10px;
        }

        /* New styles for form border */
        form {
            border: 2px solid #007bff;
            padding: 20px;
            border-radius: 5px;
        }

        /* New styles for navbar */
        .navbar {
            background-color: #007bff;
        }

        .navbar .navbar-brand,
        .navbar .nav-link {
            color: #ffff;
        }

        .navbar-toggler {
            color: #fff;
            border-color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="album.php">Halaman Edit Album</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
                    <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="laporan.php">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="profile.php"><i class="fas fa-user"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Halaman Edit Album</h1>
        <p>Selamat datang <b><?=$_SESSION['namalengkap']?></b></p>

        <form action="update_album.php" method="post">
                <?php
                include "koneksi.php";
                $albumid = $_GET['albumid'];
                $sql = mysqli_query($conn, "SELECT * FROM album WHERE albumid='$albumid'");
                while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <input type="hidden" name="albumid" value="<?=$data['albumid']?>">
                    <div class="mb-3">
                        <label for="namaAlbum" class="form-label">Nama Album</label>
                        <input type="text" id="namaAlbum" name="namaalbum" value="<?=$data['namaalbum']?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control"><?=$data['deskripsi']?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                <?php
                }
                ?>
        </form>

    </div>
    <?php
    include 'footer.php';
    ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
