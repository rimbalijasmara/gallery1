<?php
include "koneksi.php";
session_start();

$fotoid = $_GET['fotoid'];

$sql = mysqli_query($conn, "DELETE FROM foto WHERE fotoid='$fotoid'");

if ($sql) {
    echo "<script>alert('Berhasil menghapus foto!');</script>";
} else {
    echo "<script>alert('Gagal menghapus foto. Silakan coba lagi.');</script>";
}

header("location:foto.php");
?>
