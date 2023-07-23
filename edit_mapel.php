<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
require_once "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $nama_mapel = $_POST['nama_mapel'];

        $sql = "UPDATE mapel SET id_mapel='$id', nama_mapel='$nama_mapel' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: read_mapel.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    $sql = "SELECT * FROM mapel WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Mapel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Mapel</h2>
        <a href="read_mapel.php" class="btn btn-primary my-2">Kembali ke Daftar Mapel</a>
        <form method="post" action="">
            <div class="mb-3">
                <label for="id_mapel" class="form-label">ID Mapel:</label>
                <input type="text" name="id_mapel" class="form-control" value="<?php echo $data['id_mapel']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_mapel" class="form-label">Nama Mapel:</label>
                <input type="text" name="nama_mapel" class="form-control" value="<?php echo $data['nama_mapel']; ?>" required>
            </div>
            <button type="submit" name="edit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>
    <?php include 'navbar.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
</body>
</html>
