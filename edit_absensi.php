<?php
require_once "koneksi.php";

if (isset($_GET['id'])) {
    $id_absensi = $_GET['id'];

    if (isset($_POST['edit'])) {
        $nip_guru = $_POST['nip_guru'];
        $id_mapel = $_POST['id_mapel'];
        $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];

        // Query untuk mengupdate data absensi
        $sql = "UPDATE absensi SET nip_guru='$nip_guru', id_mapel='$id_mapel', tanggal='$tanggal', keterangan='$keterangan' WHERE id_absensi=$id_absensi";
        if (mysqli_query($conn, $sql)) {
            header("Location: read_absensi.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    $sql = "SELECT * FROM absensi WHERE id_absensi=$id_absensi";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Absensi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha
    <div class="container mt-5">
        <h2>Edit Data Absensi</h2>
        <form method="post" action="">
            <input type="hidden" name="id_absensi" value="<?php echo $data['id_absensi']; ?>">
            <div class="mb-3">
                <label for="nip_guru" class="form-label">NIP Guru:</label>
                <input type="text" class="form-control" id="nip_guru" name="nip_guru" value="<?php echo $data['nip_guru']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_mapel" class="form-label">ID Mapel:</label>
                <input type="text" class="form-control" id="id_mapel" name="id_mapel" value="<?php echo $data['id_mapel']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan:</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $data['keterangan']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="edit">Simpan Perubahan</button>
        </form>
    </div>
    <?php include 'navbar.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
</body>
</html>
