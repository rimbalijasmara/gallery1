<?php
include "koneksi.php";
session_start();

$namaalbum = mysqli_real_escape_string($conn, $_POST['namaalbum']);
$deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
$tanggaldibuat = date("Y-m-d");
$userid = $_SESSION['userid'];

$sql = mysqli_query($conn, "INSERT INTO album (namaalbum, deskripsi, tanggaldibuat, userid) VALUES ('$namaalbum', '$deskripsi', '$tanggaldibuat', '$userid')");

if ($sql) {
    echo "<script>alert('Berhasil membuat album!');</script>";
} else {
    echo "<script>alert('Gagal membuat album. Silakan coba lagi.');</script>";
}

header("location: album.php");
?>
