<?php
// Menghubungkan ke database
require 'koneksi.php';

// Mulai sesi PHP
session_start();

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil input dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengamankan input user agar tidak rentan terhadap SQL Injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Query untuk memeriksa username dan password di database
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    // Memeriksa apakah query berhasil dijalankan
    if (!$result) {
        die("Query gagal: " . $conn->error);
    }

    // Memeriksa apakah ada hasil yang cocok
    if ($result->num_rows > 0) {
        // Ambil data pengguna
        $row = $result->fetch_assoc();

        // Verifikasi password (asumsi password belum dienkripsi)
        if ($password === $row['password']) {
            // Simpan data login ke sesi
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            // Arahkan ke dashboard sesuai dengan peran pengguna
            if ($row['username'] === 'admin') {
                header('Location: dashboard_admin.php');
                exit();
            } else if ($row['username'] === 'superadmin') {
                header('Location: dashboard_superadmin.php');
                exit();
            } else {
                echo "Login berhasil! Selamat datang, " . htmlspecialchars($row['name']);
            }
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }

    // Menutup koneksi ke database
    $conn->close();
}
?>
