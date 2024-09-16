<?php
// Mulai sesi PHP
session_start();

// Hapus semua data sesi
session_unset();
session_destroy();

// Arahkan ke halaman login dengan pesan konfirmasi
header('Location: index.php');
exit();
?>
