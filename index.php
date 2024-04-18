<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Landing Utama</title>
      <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <style>
        body {
            background-color: #f0f9ff;
        }
        .navbar {
            background-color: #007bff;
            position: sticky;
            top: 0;
            z-index: 1000;
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
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fa-solid fa-house"></i> Halaman Landing <!-- Ganti class "fas fa-globe" dengan ikon Font Awesome yang Anda inginkan -->
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
                    <li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fa-solid fa-user"></i></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
    <div class="container my-3">
        <div class="jumbotron jumbotron-fluid bg-primary text-white">
            <div class="container">
                <?php
                    if(isset($_SESSION['userid'])){
                        echo '<h1 class="display-4">Halo, ' . $_SESSION['namalengkap'] . '!</h1>';
                        echo '<p class="lead">Selamat datang di Halaman Landing.</p>';
                    }
                ?>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            
            <?php
                include "koneksi.php";
                $sql=mysqli_query($conn,"select * from foto,user where foto.userid=user.userid");
                while($data=mysqli_fetch_array($sql)){
            ?>
                <div class="col">
                    <div class="card">
                        <a href="gambar/<?=$data['lokasifile']?>" class="popup-image">
                            <img src="gambar/<?=$data['lokasifile']?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?=$data['judulfoto']?></h5>
                            <p class="card-text">Upload By:<?=$data['namalengkap']?></p>
                            <p class="card-text"><?=$data['deskripsifoto']?></p>
                            <a href="like.php?fotoid=<?= $data['fotoid'] ?>" name="suka"><i class="fa-regular fa-thumbs-up fa-lg"></i></a>
                            <?php
                                $fotoid = $data['fotoid'];
                                $like = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($like) . ' Like';
                            ?>
                            <a href="komentar.php?fotoid=<?=$data['fotoid']?>"><i class="fa-regular fa-comment fa-lg"></i></a>
                            <?php $jmlkomen= mysqli_query($conn,"SELECT * FROM komentarfoto WHERE fotoid= '$fotoid' ");
                            echo mysqli_num_rows($jmlkomen) . ' Komentar';
                            ?>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Magnific Popup JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.popup-image').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    </script>
    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.navbar').addClass('sticky-nav');
            } else {
                $('.navbar').removeClass('sticky-nav');
            }
        });
    </script>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
