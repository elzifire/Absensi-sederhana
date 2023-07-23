<?php
session_start();
require_once "koneksi.php";

// Cek apakah pengguna sudah login, jika tidak, arahkan kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil bulan dan tahun dari filter
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

// Query untuk mengambil data absensi setiap guru berdasarkan bulan dan tahun
$sql = "SELECT guru.id AS id_guru, guru.nama AS nama_guru, COUNT(absensi.id_absensi) AS jumlah_absen 
        FROM guru 
        LEFT JOIN absensi ON guru.nip = absensi.nip_guru 
        WHERE MONTH(absensi.tanggal) = '$bulan' AND YEAR(absensi.tanggal) = '$tahun'
        GROUP BY guru.id, guru.nama";
$result = mysqli_query($conn, $sql);

// Membuat array asosiatif untuk menyimpan jumlah absensi setiap guru
$absensi_per_guru = array();
while ($row = mysqli_fetch_assoc($result)) {
    $id_guru = $row['id_guru'];
    $nama_guru = $row['nama_guru'];
    $jumlah_absen = $row['jumlah_absen'];

    $absensi_per_guru[$id_guru] = array(
        'nama_guru' => $nama_guru,
        'jumlah_absen' => $jumlah_absen
    );
}

// Query untuk menghitung jumlah kehadiran guru dalam bulan dan tahun yang dipilih
$sql_jumlah_hadir = "SELECT COUNT(*) AS jumlah_hadir FROM absensi WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND keterangan='Hadir'";
$result_jumlah_hadir = mysqli_query($conn, $sql_jumlah_hadir);
$data_jumlah_hadir = mysqli_fetch_assoc($result_jumlah_hadir);
$jumlah_hadir = $data_jumlah_hadir['jumlah_hadir'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rekap Absensi Guru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-8">
            <h3>Rekap Absensi Guru</h3>
               
            </div>
            <div class="col-md-4 text-end">
                <a href="logout.php" class="btn btn-danger"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>

        <div class="mt-4">
            <form action="" method="get" class="mb-3">
                <label for="bulan">Pilih Bulan:</label>
                <select name="bulan" id="bulan">
                    <?php
                    // Loop untuk menampilkan pilihan bulan
                    for ($i = 1; $i <= 12; $i++) {
                        $selected = ($bulan == $i) ? "selected" : "";
                        echo "<option value='$i' $selected>" . date('F', mktime(0, 0, 0, $i, 1)) . "</option>";
                    }
                    ?>
                </select>
                <label for="tahun">Pilih Tahun:</label>
                <select name="tahun" id="tahun">
                    <?php
                    // Loop untuk menampilkan pilihan tahun
                    $current_year = date('Y');
                    for ($i = $current_year; $i >= $current_year - 5; $i--) {
                        $selected = ($tahun == $i) ? "selected" : "";
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
            <p>Jumlah Kehadiran Guru Bulan <?php echo date('F', mktime(0, 0, 0, $bulan, 1)) . " " . $tahun; ?>: <?php echo $jumlah_hadir; ?> kali</p>
        </div>

        <div class="mt-4">
            <h3>Rekap Absensi Guru</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Guru</th>
                        <th>Jumlah Absensi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($absensi_per_guru as $id_guru => $data_guru) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $data_guru['nama_guru'] . "</td>";
                        echo "<td>" . $data_guru['jumlah_absen'] . "</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include 'navbar.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
</body>
</html>
