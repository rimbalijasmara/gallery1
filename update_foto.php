<?php
include "koneksi.php";
session_start();

if(isset($_POST['judulfoto'], $_POST['deskripsifoto'], $_POST['albumid'], $_POST['fotoid'])) {
    $judulfoto = mysqli_real_escape_string($conn, $_POST['judulfoto']);
    $deskripsifoto = mysqli_real_escape_string($conn, $_POST['deskripsifoto']);
    $albumid = mysqli_real_escape_string($conn, $_POST['albumid']);
    $fotoid = mysqli_real_escape_string($conn, $_POST['fotoid']);

    // Jika Upload gambar baru
    if($_FILES['lokasifile']['name'] != "") {
        $rand = rand();
        $ekstensi = array('png', 'jpg', 'jpeg', 'gif');
        $filename = $_FILES['lokasifile']['name'];
        $ukuran = $_FILES['lokasifile']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if(!in_array($ext, $ekstensi)) {
            echo "<script>alert('Ekstensi file tidak diperbolehkan.');</script>";
            header("location:foto.php");
            exit();
        } else {
            if($ukuran < 1044070) {
                $xx = $rand . '_' . $filename;
                move_uploaded_file($_FILES['lokasifile']['tmp_name'], 'gambar/' . $rand . '_' . $filename);
                mysqli_query($conn, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', lokasifile='$xx', albumid='$albumid' WHERE fotoid='$fotoid'");
                echo "<script>alert('Berhasil mengedit foto!');</script>";
                header("location:foto.php");
                exit();
            } else {
                echo "<script>alert('Ukuran file terlalu besar.');</script>";
                header("location:foto.php");
                exit();
            }
        }
    } else {
        mysqli_query($conn, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', albumid='$albumid' WHERE fotoid='$fotoid'");
        echo "<script>alert('Berhasil mengedit foto!');</script>";
        header("location:foto.php");
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}
?>
