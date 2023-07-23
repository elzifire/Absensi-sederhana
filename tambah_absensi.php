<?php
session_start();
require_once "koneksi.php";

// Cek apakah pengguna sudah login, jika tidak, arahkan kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
require_once "koneksi.php";

if (isset($_POST['tambah'])) {
    $nip_guru = $_POST['nip_guru'];
    $id_mapel = $_POST['id_mapel'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];

    // Query untuk menambah data absensi
    $sql = "INSERT INTO absensi (nip_guru, id_mapel, tanggal, keterangan) VALUES ('$nip_guru', '$id_mapel', '$tanggal', '$keterangan')";
    if (mysqli_query($conn, $sql)) {
        header("Location: read_absensi.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Absensi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Data Absensi</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="nip_guru" class="form-label">NIP Guru:</label>
                <input type="text" class="form-control" id="nip_guru" name="nip_guru" required>
            </div>
            <div class="mb-3">
                <label for="id_mapel" class="form-label">ID Mapel:</label>
                <input type="text" class="form-control" id="id_mapel" name="id_mapel" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan:</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Hadir" name="keterangan[]" id="chkHadir">
                    <label class="form-check-label" for="chkHadir">Hadir</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Izin" name="keterangan[]" id="chkIzin">
                    <label class="form-check-label" for="chkIzin">Izin</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Alfa" name="keterangan[]" id="chkAlfa">
                    <label class="form-check-label" for="chkAlfa">Alfa</label>
                </div>
            </div>
            <div class="mb-3" id="formIzin" style="display: none;">
                <label for="keterangan_izin" class="form-label">Keterangan Izin:</label>
                <input type="text" class="form-control" id="keterangan_izin" name="keterangan_izin">
            </div>
            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
        </form>
    </div>
    <?php include 'navbar.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
    <script>
        // Fungsi untuk menampilkan/menyembunyikan form tambahan berdasarkan checkbox izin
        $(document).ready(function() {
            $("#chkIzin").change(function() {
                if ($(this).is(":checked")) {
                    $("#formIzin").show();
                } else {
                    $("#formIzin").hide();
                }
            });
        });
    </script>
</body>
</html>
