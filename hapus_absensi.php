<?php
require_once "koneksi.php";

if (isset($_GET['id'])) {
    $id_absensi = $_GET['id'];

    // Query untuk menghapus data absensi
    $sql = "DELETE FROM absensi WHERE id_absensi=$id_absensi";
    if (mysqli_query($conn, $sql)) {
        header("Location: read_absensi.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
