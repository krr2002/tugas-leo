<?php
// Konfigurasi koneksi database
$host = "localhost"; // Ganti dengan host jika perlu
$dbname = "titik_temu"; // Nama database
$username = "root"; // Username database
$password = ""; // Password database (kosong jika default)

try {
    // Membuat koneksi ke database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Cek jika form dikirimkan menggunakan POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // Validasi password dan konfirmasi password
    if ($pass != $confirm_pass) {
        die("Password dan konfirmasi password tidak cocok.");
    }

    // Enkripsi password menggunakan bcrypt
    $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

    // Cek apakah username sudah ada
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$user]);
    $existing_user = $stmt->fetch();

    if ($existing_user) {
        die("Username sudah digunakan.");
    }

    // Masukkan data pengguna baru ke dalam database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user, $email, $hashed_pass]);

    // Redirect ke halaman login setelah registrasi berhasil
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TITIK TEMU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="C:\Users\62823\Desktop\tugas-leo\css\styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="base.html">TITIK TEMU</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Daftar Akun</h2>
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

