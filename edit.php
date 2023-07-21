<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Pengguna</title>
</head>
<body>
    <?php
    require_once 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];

        // Ambil data pengguna berdasarkan ID
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = $conn->query($query);

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
    ?>
            <h2>Edit Data Pengguna</h2>
            <form method="post" action="update.php">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <label>Username:</label><br>
                <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br><br>
                <label>Email:</label><br>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>
                <input type="submit" value="Update">
            </form>
    <?php
        } else {
            echo "Data pengguna tidak ditemukan.";
        }
    }
    ?>
</body>
</html>
