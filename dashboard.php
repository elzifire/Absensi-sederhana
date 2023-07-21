<?php
session_start();

// Cek apakah pengguna sudah login, jika tidak, arahkan kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Dashboard</title>
    <!-- Load Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
        <div class="container">
            <!-- Tabel untuk menampilkan data -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Umur</th>
                        <th scope="col">Email</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>30</td>
                        <td>john.doe@example.com</td>
                        <td>
                            <!-- Tombol aksi untuk mengedit dan menghapus data -->
                            <button type="button" class="btn btn-primary" onclick="showEditModal(1)">Edit</button>
                            <button type="button" class="btn btn-danger" onclick="deleteData(1)">Hapus</button>
                        </td>
                    </tr>
                    <!-- Data dari database akan ditampilkan di sini -->
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal untuk menambahkan dan mengedit data -->
    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Isi modal -->
            </div>
        </div>
    </div>

    <!-- Load Bootstrap JS dan Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>

   

    <a href="logout.php">Logout</a>
</body>
</html>
