<?php
require_once 'koneksi.php';

// Mendapatkan username, password, dan email dari form pendaftaran
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Hash password menggunakan fungsi password_hash() sebelum menyimpannya ke database
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Simpan data pengguna ke dalam tabel
$query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
$result = $conn->query($query);

// Cek apakah proses pendaftaran berhasil
if ($result) {
    // Berhasil mendaftar, redirect ke halaman login
    header("Location: login.php");
    exit;
} else {
    // Gagal mendaftar, tampilkan pesan kesalahan atau lakukan penanganan kesalahan lainnya
    echo "Gagal mendaftar pengguna: " . $conn->error;
}
?>
