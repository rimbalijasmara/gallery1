<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-light">
    <div class="container">
        <a class="navbar-brand text-light" href="index.php">
            <i class="fas fa-user"></i> Halaman Landing
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php
                session_start();
                if(!isset($_SESSION['userid'])){
                ?>
                    <li class="nav-item"><a class="nav-link text-light" href="register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="login.php">Login</a></li>
                <?php
                } else {
                ?>
                    <li class="nav-item"><a class="nav-link text-light" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="album.php">Album</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="foto.php">Foto</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="logout.php">Logout</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="laporan.php">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="profile.php"><i class="fas fa-user"></i></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
    <div class="container">
        <?php
        // Include koneksi ke basis data
        include 'koneksi.php';

        // Periksa apakah user_id sudah ada dalam sesi
        if(isset($_SESSION['userid'])) {
            $userid = $_SESSION['userid'];

            // Query untuk mengambil data pengguna
            $queryUser = mysqli_query($conn, "SELECT * FROM user WHERE userid = '$userid'");
            $user = mysqli_fetch_assoc($queryUser);

            // Query untuk mengambil album-album pengguna berdasarkan userid
            $queryAlbum = mysqli_query($conn, "SELECT * FROM album WHERE userid = '$userid'");

            // Query untuk menghitung jumlah foto yang diunggah oleh pengguna
            $queryJumlahFoto = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM foto WHERE userid = '$userid'");
            $jumlahFoto = mysqli_fetch_assoc($queryJumlahFoto)['jumlah'];

            // Menampilkan informasi pengguna
            ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mt-5">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="User Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= $user['namalengkap'] ?></h5>
                            <p class="card-text"><?= $user['alamat'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mt-5">
                        <div class="card-header">
                            <h5>User Information</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">Username: <?= $user['username'] ?></li>
                                <li class="list-group-item">Email: <?= $user['email'] ?></li>
                                <!-- Tambahkan informasi jumlah foto -->
                                <li class="list-group-item">Jumlah Foto: <?= $jumlahFoto ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>User Albums</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            if (mysqli_num_rows($queryAlbum) > 0) {
                                echo "<ul>";
                                while ($album = mysqli_fetch_assoc($queryAlbum)) {
                                    echo "<li>" . $album['namaalbum'] . "</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<p>Tidak ada album yang dibuat.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            // Jika user_id tidak ditemukan dalam sesi, maka berikan pesan kesalahan
            echo "<p>Anda tidak memiliki akses ke halaman ini. Silakan login terlebih dahulu.</p>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php
include 'footer.php'; ?>
</html>
