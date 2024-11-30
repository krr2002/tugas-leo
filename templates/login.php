<?php
include('config.php'); // Koneksi database

session_start(); // Mulai sesi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah pengguna ada di database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Simpan ID pengguna dalam sesi
            $_SESSION['username'] = $user['username']; // Simpan username dalam sesi
            header("Location: base.html"); // Redirect ke halaman utama setelah login
            exit;
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}
?>
