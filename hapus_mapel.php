<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
require_once "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM mapel WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: read_mapel.php"); // Ganti "index.php" dengan halaman yang sesuai
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
