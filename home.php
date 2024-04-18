<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f9ff;
            padding-bottom: 80px; /* Jarak bawah agar footer tidak tumpang tindih dengan konten */
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #0d6efd;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .navbar {
            background-color: #007bff;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar .nav-link {
            color: #fff;
        }
        .jumbotron {
            background-color: #007bff;
            color: #fff;
        }
        .card {
            background-color: #e9f2fa;
        }
        .card-header {
            background-color: #007bff;
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
        .popup-image img {
            transition: transform 0.3s ease;
        }
        .popup-image:hover img {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
             <a class="navbar-brand" href="index.php">
            <i class="fa-solid fa-house"></i> Halaman <!-- Ganti class "fas fa-globe" dengan ikon Font Awesome yang Anda inginkan -->
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
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php
                        } else {
                    ?>
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
                        <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="laporan.php">Laporan</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="profile.php"><i class="fas fa-user"></i></a></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h1>Welcome to Our Website</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis dapibus leo, id sodales
                        tellus. Suspendisse vel ligula eu justo gravida consequat.</p>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </main>
<?php
include 'footer.php';?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
