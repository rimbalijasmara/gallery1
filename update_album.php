<?php
include "koneksi.php";
session_start();

if(isset($_POST['albumid']) && isset($_POST['namaalbum']) && isset($_POST['deskripsi'])) {
    $albumid = $_POST['albumid'];
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi' WHERE albumid='$albumid'";
    if(mysqli_query($conn, $sql)) {
        header("location:album.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}
?>
