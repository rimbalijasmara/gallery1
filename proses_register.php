<?php
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];

$sql = mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password', '$email', '$namalengkap', '$alamat')");

if ($sql) {
    echo "<script>alert('Registrasi berhasil berhasil!');</script>";
} else {
    echo "<script>alert('Gagal registrasi. Silakan coba lagi.');</script>";
}

header("location:login.php");
?>
