<?php
include "koneksi.php"; // Pastikan path file koneksi.php sesuai dengan struktur folder Anda
session_start();

// Filter dan escape parameter albumid
$albumid = mysqli_real_escape_string($conn, $_GET['albumid']);

// Periksa apakah albumid valid sebelum melakukan kueri DELETE
if (!empty($albumid) && is_numeric($albumid)) {
    $sql = mysqli_query($conn, "DELETE FROM album WHERE albumid='$albumid'");

    if ($sql) {
        echo "<script>alert('Berhasil menghapus album!');</script>";
    } else {
        echo "<script>alert('Gagal menghapus album. Silakan coba lagi.');</script>";
    }
} else {
    echo "<script>alert('Albumid tidak valid');</script>";
}

header("location:album.php");
?>
