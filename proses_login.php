<?php
include "koneksi.php";
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");

$cek = mysqli_num_rows($sql);

if ($cek == 1) {
    while ($data = mysqli_fetch_array($sql)) {
        $_SESSION['userid'] = $data['userid'];
        $_SESSION['namalengkap'] = $data['namalengkap'];
    }
    echo "<script>alert('Login berhasil!');</script>";
    header("location:home.php");
} else {
    echo "<script>alert('Login gagal. Silakan coba lagi.');</script>";
    header("location:login.php");
}
?>
