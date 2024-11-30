<?php
session_start(); // Mulai sesi
session_unset(); // Hapus semua data sesi
session_destroy(); // Hancurkan sesi
header("Location: login.html"); // Redirect ke halaman login setelah logout
exit;
?>
