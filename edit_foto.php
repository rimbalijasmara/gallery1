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
    <title>Halaman Edit Foto</title>
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
            background-color: #007bff !important; /* Ubah warna background navbar menjadi biru */
        }
        .container {
            max-width: 800px; /* Perbesar lebarnya agar form terlihat lebih luas */
            margin: 0 auto;
            border: 1px solid #007bff; /* Ubah border menjadi warna biru */
            padding: 20px; /* Berikan padding agar konten tidak terlalu dekat dengan border */
            border-radius: 10px; /* Agar border memiliki sudut yang lebih lembut */
        }
        h1 {
            color: #007bff;
            margin-bottom: 20px; /* Berikan jarak antara judul dan form */
        }
        .form-control {
            margin-bottom: 15px; /* Berikan jarak antara input dengan elemen lain */
        }
        .form-label {
            font-weight: bold; /* Jadikan label lebih tebal */
        }
        .form-divider {
            border-top: 1px solid #007bff; /* Ubah warna garis pembatas menjadi biru */
            margin: 20px 0; /* Berikan margin atas dan bawah */
        }
        .navbar-nav .nav-link {
            color: #fff !important; /* Ubah warna teks navbar menjadi putih */
        }
        .navbar-light .navbar-toggler-icon {
            background-color: #fff; /* Ubah warna ikon toggler navbar menjadi putih */
        }
        .navbar-light .navbar-toggler {
            border-color: #fff; /* Ubah warna border toggler navbar menjadi putih */
        }
        .navbar-light .navbar-toggler:focus, .navbar-light .navbar-toggler:active {
            outline: none;
            box-shadow: none;
        }
        .navbar-light .navbar-toggler:hover {
            background-color: #0056b3; /* Ubah warna background toggler navbar saat hover menjadi biru tua */
            border-color: #0056b3; /* Ubah warna border toggler navbar saat hover menjadi biru tua */
        }
        .navbar-brand {
            color: #fff !important; /* Ubah warna teks menjadi putih */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <i class="fa-regular fa-image"></i> Halaman Foto <!-- Ganti class "fas fa-globe" dengan ikon Font Awesome yang Anda inginkan -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="album.php">Album</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="foto.php">Foto</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="laporan.php">Laporan</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="profile.php"><i class="fas fa-user"></i></a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1>Halaman Edit Foto</h1>
    <p>Selamat datang <b><?=$_SESSION['namalengkap']?></b></p>
    
    <form action="update_foto.php" method="post" enctype="multipart/form-data" style="border: 1px solid #007bff; padding: 20px; border-radius: 10px;">
        <?php
            include "koneksi.php";
            $fotoid=$_GET['fotoid'];
            $userid=$_SESSION['userid'];
            $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid' AND userid='$userid'");
            if(mysqli_num_rows($sql) > 0) {
                $data=mysqli_fetch_array($sql);
        ?>
        <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
        <div class="mb-3">
            <label for="judulFoto" class="form-label">Judul</label>
            <input type="text" id="judulFoto" name="judulfoto" value="<?=$data['judulfoto']?>" class="form-control" required>
        </div>
        <hr class="form-divider"> <!-- Tambahkan garis pembatas -->
        <div class="mb-3">
            <label for="deskripsiFoto" class="form-label">Deskripsi</label>
            <input type="text" id="deskripsiFoto" name="deskripsifoto" value="<?=$data['deskripsifoto']?>" class="form-control" required>
        </div>
        <hr class="form-divider"> <!-- Tambahkan garis pembatas -->
        <div class="mb-3">
            <label for="lokasiFile" class="form-label">Lokasi File</label>
            <input type="file" id="lokasiFile" name="lokasifile" class="form-control"required>
        </div>
        <hr class="form-divider"> <!-- Tambahkan garis pembatas -->
        <div class="mb-3">
            <label for="albumID" class="form-label">Album</label>
            <select id="albumID" name="albumid" class="form-select">
                <?php
                    $sql2=mysqli_query($conn,"select * from album where userid='$userid'");
                    while($data2=mysqli_fetch_array($sql2)){
                ?>
                        <option value="<?=$data2['albumid']?>" <?php if($data2['albumid']==$data['albumid']){echo 'selected';}?>><?=$data2['namaalbum']?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ubah</button>
        <?php
            } else {
                echo "Foto tidak ditemukan atau Anda tidak memiliki akses untuk mengedit foto ini.";
            }
        ?>
    </form>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php
    include 'footer.php';
    ?>
</html>
