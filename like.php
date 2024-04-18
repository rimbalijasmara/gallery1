<?php
    include "koneksi.php";
    session_start();

    if (!isset($_SESSION['userid'])) {
        // Jika belum login, arahkan ke halaman login
        header("location: login.php");
        exit; // tambahkan exit untuk menghentikan eksekusi selanjutnya
    }

    // Periksa apakah ada parameter fotoid yang dikirimkan melalui URL
    if (isset($_GET['fotoid'])) {
        $fotoid = $_GET['fotoid'];
        $userid = $_SESSION['userid'];

        // Periksa apakah user sudah pernah like foto ini atau belum
        $check_sql = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

        if (mysqli_num_rows($check_sql) == 1) {
            // Jika user sudah like foto ini, lakukan unlike
            $row = mysqli_fetch_array($check_sql);
            $likeid = $row['likeid'];
            $delete_sql = mysqli_query($conn, "DELETE FROM likefoto WHERE likeid='$likeid'");
            if ($delete_sql) {
                // Jika unlike berhasil, arahkan kembali ke halaman index
                header("location: index.php");
                exit; // tambahkan exit untuk menghentikan eksekusi selanjutnya
            } else {
                // Jika terjadi kesalahan saat melakukan unlike, tampilkan pesan error
                echo "Error: Gagal melakukan unlike.";
            }
        } else {
            // Jika user belum like, tambahkan data ke tabel likefoto
            $tanggallike = date("Y-m-d");
            $insert_sql = "INSERT INTO likefoto (fotoid, userid, tanggallike) VALUES ('$fotoid', '$userid', '$tanggallike')";
            if (mysqli_query($conn, $insert_sql)) {
                // Jika query berhasil dijalankan, arahkan kembali ke halaman index
                header("location: index.php");
                exit; // tambahkan exit untuk menghentikan eksekusi selanjutnya
            } else {
                // Jika terjadi kesalahan saat menambahkan data, tampilkan pesan error
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        // Jika parameter fotoid tidak tersedia, tampilkan pesan error atau arahkan ke halaman lain
        echo "Error: Parameter fotoid tidak valid.";
        // atau arahkan ke halaman lain
        // header("location: halaman_error.php");
    }
?>
