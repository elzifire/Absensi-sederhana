<?php
session_start();
session_destroy();

// Redirect kembali ke halaman login setelah logout
header("Location: index.php");
exit;
?>
