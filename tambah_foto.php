<?php
include "koneksi.php";
session_start();

$judulfoto = mysqli_real_escape_string($conn, $_POST['judulfoto']);
$deskripsifoto = mysqli_real_escape_string($conn, $_POST['deskripsifoto']);
$albumid = mysqli_real_escape_string($conn, $_POST['albumid']);
$tanggalunggah = date("Y-m-d");
$userid = $_SESSION['userid'];

$rand = rand();
$ekstensi = array('png', 'jpg', 'jpeg', 'gif');
$filename = $_FILES['lokasifile']['name'];
$ukuran = $_FILES['lokasifile']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array($ext, $ekstensi)) {
    echo "<script>alert('Ekstensi file tidak diperbolehkan.');</script>";
    header("location: foto.php");
    exit; // Keluar dari skrip setelah redirect
} else {
    if ($ukuran < 1044070) {
        $xx = $rand . '_' . $filename;
        move_uploaded_file($_FILES['lokasifile']['tmp_name'], 'gambar/' . $rand . '_' . $filename);
        $sql = mysqli_query($conn, "INSERT INTO foto (judulfoto, deskripsifoto, tanggalunggah, lokasifile, albumid, userid) VALUES ('$judulfoto', '$deskripsifoto', '$tanggalunggah', '$xx', '$albumid', '$userid')");
        if ($sql) {
            echo "<script>alert('Berhasil mengunggah foto!');</script>";
        } else {
            echo "<script>alert('Gagal mengunggah foto. Silakan coba lagi.');</script>";
        }
        header("location: foto.php");
        exit; // Keluar dari skrip setelah redirect
    } else {
        echo "<script>alert('Ukuran file terlalu besar.');</script>";
        header("location: foto.php");
        exit; // Keluar dari skrip setelah redirect
    }
}
?>
