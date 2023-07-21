<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update data pengguna berdasarkan ID
    $query = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$id'";
    $result = $conn->query($query);

    if ($result) {
        // Berhasil update, redirect kembali ke halaman dashboard atau beranda
        header("Location: dashboard.php");
        exit;
    } else {
        // Gagal update, tampilkan pesan kesalahan atau lakukan penanganan kesalahan lainnya
        echo "Gagal update data pengguna: " . $conn->error;
    }
}
?>
