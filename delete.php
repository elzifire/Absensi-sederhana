<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Hapus data pengguna berdasarkan ID
    $query = "DELETE FROM users WHERE id = '$id'";
    $result = $conn->query($query);

    if ($result) {
        // Berhasil hapus, redirect kembali ke halaman dashboard atau beranda
        header("Location: dashboard.php");
        exit;
    } else {
        // Gagal hapus, tampilkan pesan kesalahan atau lakukan penanganan kesalahan lainnya
        echo "Gagal hapus data pengguna: " . $conn->error;
    }
}
?>
