<?php
// Menghubungkan ke database
require 'koneksi.php';

// Mulai sesi PHP
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'superadmin') {
    // Jika tidak, arahkan ke halaman login
    header('Location: login.php');
    exit();
}

// Ambil data pengguna dari sesi
$username = $_SESSION['username'];

// Query untuk mendapatkan detail pengguna
$sql = "SELECT name, role FROM user WHERE username = '$username'";
$result = $conn->query($sql);

// Memeriksa apakah query berhasil dijalankan
if (!$result) {
    die("Query gagal: " . $conn->error);
}

// Mengambil data pengguna
$user = $result->fetch_assoc();

// Menutup koneksi ke database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Superadmin</title>
    <link href="public/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex flex-col min-h-screen">
        <header class="bg-red-600 text-white p-4">
            <h1 class="text-2xl font-bold">Superadmin Dashboard</h1>
            <nav>
                <a href="logout.php" class="text-white">Logout</a>
            </nav>
        </header>

        <main class="flex-1 p-6">
            <h2 class="text-xl font-semibold mb-4">Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
            <p class="text-lg">Role: <?php echo htmlspecialchars($user['role']); ?></p>
            <!-- Tambahkan konten dashboard superadmin di sini -->
        </main>

        <footer class="bg-gray-800 text-white p-4 text-center">
            <p>&copy; <?php echo date('Y'); ?> Your Company. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
