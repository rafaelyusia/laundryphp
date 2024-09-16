<?php
// Detail koneksi database
$host = 'localhost';      // Nama host
$username = 'root';       // Nama pengguna database
$password = '';           // Kata sandi database (kosong jika tidak ada)
$database = 'vslaundry';  // Nama database Anda

// Membuat koneksi ke database menggunakan MySQLi
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi, tampilkan pesan error jika gagal
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} 
?>
