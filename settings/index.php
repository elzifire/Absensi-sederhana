<?php 
session_start();

// Cek apakah pengguna sudah login, jika tidak, arahkan kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Dashboard</title>
</head>
<body>
   
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
            <!-- Konten halaman utama di sini -->
        </main>
    <h3>Data Pengguna</h3>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php
        require_once '../koneksi.php';

        // Ambil data pengguna dari database
        $query = "SELECT * FROM users";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>
                        <form method='post' action='edit.php'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' value='Edit'>
                        </form>
                        <form method='post' action='delete.php' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' value='Hapus'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data pengguna.</td></tr>";
        }
        ?>
    </table>

    <br>
    <!-- <a href="../logout.php">Logout</a> -->
</body>
</html>
