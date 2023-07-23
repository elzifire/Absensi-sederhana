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
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];
        $id_mapel = $_POST['id_mapel'];

        $sql = "UPDATE guru SET nip='$nip', nama='$nama', jabatan='$jabatan', id_mapel='$id_mapel' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: read_guru.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    $sql = "SELECT * FROM guru WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    // Ambil data mapel untuk opsi pada formulir
    $sql_mapel = "SELECT * FROM mapel";
    $result_mapel = mysqli_query($conn, $sql_mapel);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Guru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Guru</h2>
        <a href="read_guru.php" class="btn btn-primary my-2">Kembali ke Daftar Guru</a>
        <form method="post" action="">
            <div class="mb-3">
                <label for="nip" class="form-label">NIP:</label>
                <input type="text" name="nip" class="form-control" value="<?php echo $data['nip']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan:</label>
                <input type="text" name="jabatan" class="form-control" value="<?php echo $data['jabatan']; ?>">
            </div>
            <div class="mb-3">
                <label for="id_mapel" class="form-label">Nama Mapel:</label>
                <select name="id_mapel" class="form-select" required>
                    <option value="" selected disabled>Pilih Nama Mapel</option>
                    <?php while ($row_mapel = mysqli_fetch_assoc($result_mapel)) { ?>
                        <option value="<?php echo $row_mapel['id']; ?>" <?php if ($row_mapel['id'] == $data['id_mapel']) echo 'selected'; ?>><?php echo $row_mapel['nama_mapel']; ?></option>
                    <?php } ?>
                </select>
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
