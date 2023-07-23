<?php
session_start();
require_once "koneksi.php";

// Cek apakah pengguna sudah login, jika tidak, arahkan kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Query untuk menghitung jumlah guru
$sql_jumlah_guru = "SELECT COUNT(*) AS jumlah_guru FROM guru";
$result_jumlah_guru = mysqli_query($conn, $sql_jumlah_guru);
$data_jumlah_guru = mysqli_fetch_assoc($result_jumlah_guru);
$jumlah_guru = $data_jumlah_guru['jumlah_guru'];

// Query untuk menghitung jumlah mapel
$sql_jumlah_mapel = "SELECT COUNT(*) AS jumlah_mapel FROM mapel";
$result_jumlah_mapel = mysqli_query($conn, $sql_jumlah_mapel);
$data_jumlah_mapel = mysqli_fetch_assoc($result_jumlah_mapel);
$jumlah_mapel = $data_jumlah_mapel['jumlah_mapel'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Guru</h5>
                        <p class="card-text"><?php echo $jumlah_guru; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Mapel</h5>
                        <p class="card-text"><?php echo $jumlah_mapel; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'navbar.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
</body>
</html>
