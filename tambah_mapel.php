<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
require_once "koneksi.php";

if (isset($_POST['tambah'])) {
    $id_mapel = $_POST['id_mapel'];
    $nama_mapel = $_POST['nama_mapel'];

    $sql = "INSERT INTO mapel (id_mapel, nama_mapel) VALUES ('$id_mapel', '$nama_mapel')";
    if (mysqli_query($conn, $sql)) {
        header("Location: read_mapel.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mapel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Tambah Mapel</h2>
        <a href="read_mapel.php" class="btn btn-primary my-2">Kembali ke Daftar Mapel</a>
        <form method="post" action="">
            <div class="mb-3">
                <label for="id_mapel" class="form-label">ID Mapel:</label>
                <input type="text" name="id_mapel" class="form-control" autofocus required>
            </div>
            <div class="mb-3">
                <label for="nama_mapel" class="form-label">Nama Mapel:</label>
                <input type="text" name="nama_mapel" class="form-control" required>
            </div>
            <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
        </form>
    </div>
<?php include 'navbar.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
</body>
</html>
