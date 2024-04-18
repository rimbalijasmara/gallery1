<?php
include "koneksi.php";
session_start();

$fotoid = $_POST['fotoid'];
$isikomentar = $_POST['isikomentar'];
$tanggalkomentar = date("Y-m-d");
$userid = $_SESSION['userid'];

// Modifikasi kueri SQL dengan menambahkan kondisi WHERE untuk membatasi ID foto yang dikomentari
$sql = mysqli_query($conn, "INSERT INTO komentarfoto (fotoid, userid, isikomentar, tanggalkomentar) VALUES ('$fotoid', '$userid', '$isikomentar', '$tanggalkomentar')");

if ($sql) {
    echo "<script>alert('Berhasil menambahkan komentar!');</script>";
} else {
    echo "<script>alert('Gagal menambahkan komentar. Silakan coba lagi.');</script>";
}

header("location:komentar.php?fotoid=" . $fotoid);
?>
