<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

require_once "koneksi.php";

// Jika parameter ID tidak ada, arahkan kembali ke halaman read_user.php
if (!isset($_GET['id'])) {
    header("Location: read_user.php");
    exit;
}

$id = $_GET['id'];

// Query untuk menghapus data user berdasarkan ID
$sql = "DELETE FROM users WHERE id='$id'";
mysqli_query($conn, $sql);

header("Location: read_user.php");
exit;
?>
