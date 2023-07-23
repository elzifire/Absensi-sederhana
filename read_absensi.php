<?php
session_start();

// Cek apakah pengguna sudah login, jika tidak, arahkan kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
require_once "koneksi.php";

// Fungsi untuk menghitung total data absensi
function getTotalRows($conn) {
    $sql = "SELECT COUNT(*) AS total_rows FROM absensi";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total_rows'];
}

// Konfigurasi pagination
$rows_per_page = 10;
$total_rows = getTotalRows($conn);
$total_pages = ceil($total_rows / $rows_per_page);

// Mendapatkan halaman yang sedang aktif
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Mengatur batas data yang ditampilkan
$start_row = ($current_page - 1) * $rows_per_page;
$sql = "SELECT * FROM absensi LIMIT $start_row, $rows_per_page";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Absensi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Data Absensi</h2>
        <a href="tambah_absensi.php" class="btn btn-success mb-3">Tambah Data</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Absensi</th>
                    <th>NIP Guru</th>
                    <th>ID Mapel</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id_absensi']; ?></td>
                        <td><?php echo $row['nip_guru']; ?></td>
                        <td><?php echo $row['id_mapel']; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['keterangan']; ?></td>
                        <td>
                            <a href="edit_absensi.php?id=<?php echo $row['id_absensi']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_absensi.php?id=<?php echo $row['id_absensi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data absensi ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <?php include 'navbar.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
</body>
</html>
