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
    <title>Halaman Album</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
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

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #bd2130;
            border-color: #bd2130;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .table {
            background-color: #fff;
            border: 1px solid #dee2e6; /* Tambahkan garis tepi (border) */
            border-collapse: collapse; /* Agar garis tepi tabel menyatu */
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid #dee2e6; /* Tambahkan garis tepi (border) untuk sel header dan sel data */
            padding: 8px; /* Sesuaikan padding agar konten terlihat lebih jelas */
            text-align: left;
        }

        .table th {
            background-color: #f8f9fa; /* Warna latar belakang header */
            color: #333; /* Warna teks header */
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05); /* Warna latar belakang baris ganjil */
        }

        /* CSS baru untuk form dengan border */
        .form-border {
            border: 1px solid #dee2e6;
            padding: 10px;
            margin-bottom: 10px; /* Tambahkan margin-bottom untuk jarak antara form dan elemen lain */
        }

        /* Padding untuk label pada form */
        .form-label {
            margin-bottom: 5px; /* Jarak antara label dan input */
        }

        /* Padding untuk input pada form */
        .form-control {
            padding: 6px 10px; /* Sesuaikan padding input */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fa-solid fa-folder"></i> Halaman Album <!-- Ganti class "fas fa-globe" dengan ikon Font Awesome yang Anda inginkan -->
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
                    <li class="nav-item"><a class="nav-link text-light" href="laporan.php">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="profile.php"><i class="fas fa-user"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="mt-3">Halaman Album</h1>
        <p>Selamat datang <b><?=$_SESSION['namalengkap']?></b></p>
        
        <form action="tambah_album.php" method="post" class="form-border">
            <div class="mb-3">
                <label for="namaAlbum" class="form-label">Nama Album</label>
                <input type="text" id="namaAlbum" name="namaalbum" class="form-control">
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>


        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Tanggal dibuat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "koneksi.php";
                $userid=$_SESSION['userid'];
                $sql=mysqli_query($conn,"select * from album where userid='$userid'");
                while($data=mysqli_fetch_array($sql)){
                ?>
                <tr>
                    <td><?=$data['albumid']?></td>
                    <td><?=$data['namaalbum']?></td>
                    <td><?=$data['deskripsi']?></td>
                    <td><?=$data['tanggaldibuat']?></td>
                    <td>
                        <a href="edit_album.php?albumid=<?=$data['albumid']?>" class="btn btn-warning">Edit</a>
                        <a href="hapus_album.php?albumid=<?=$data['albumid']?>" class="btn btn-danger">Hapus</a>
                    </td>
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
