<?php
// Menghubungkan ke database
require 'koneksi.php';

// Mulai sesi PHP
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.26.0/dist/full.css" rel="stylesheet">
    <style>
        .sidebar {
            background-color: #f3f4f6; /* Warna latar belakang sidebar */
            height: 100vh;
            border-right: 1px solid #e5e7eb;
        }
        .logo {
            max-width: 120px; /* Ukuran logo */
            height: auto;
        }
        .menu-item {
            transition: background-color 0.3s; 
        }
        .menu-item:hover {
            background-color: #e0f2fe; /* Warna latar belakang saat hover */
        }
    </style>
    <script>
        function updatePrice() {
            const service = document.getElementById('service').value;
            const kilograms = parseFloat(document.getElementById('kilograms').value) || 0;
            let pricePerKg = 0;

            // Tentukan harga per kilogram berdasarkan layanan
            switch (service) {
                case 'Cuci Kering':
                    pricePerKg = 5000; // Harga cuci kering per kilogram
                    break;
                case 'Cuci Setrika':
                    pricePerKg = 10000; // Harga cuci setrika per kilogram
                    break;
                case 'Seprei Kecil':
                    pricePerKg = 7000; // Harga seprei kecil per kilogram
                    break;
                case 'Seprei Besar':
                    pricePerKg = 7000; // Harga seprei besar per kilogram
                    break;
                case 'Selimut Kecil':
                    pricePerKg = 7000; // Harga selimut kecil per kilogram
                    break;
                case 'Selimut Besar':
                    pricePerKg = 7000; // Harga selimut besar per kilogram
                    break;
                case 'Cuci Boneka':
                    pricePerKg = 10000; // Harga cuci boneka per kilogram
                    break;
                case 'Cuci Sepatu':
                    pricePerKg = 10000; // Harga cuci sepatu per kilogram
                    break;
                default:
                    pricePerKg = 0;
            }

            // Hitung harga total
            const totalPrice = pricePerKg * kilograms;
            document.getElementById('price').value = totalPrice;
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar w-64 p-6">
            <div class="flex items-center justify-center mb-6">
                <img src="assets/img/logovslaundry.PNG" alt="Logo" class="logo">
            </div>
            <ul class="menu p-4 bg-white rounded-lg shadow-md space-y-2">
                <li><a href="dashboard_admin.php" class="menu-item font-semibold text-blue-700 p-2 rounded-md">Dashboard</a></li>
                <li><a href="customers.php" class="menu-item font-semibold text-gray-700 p-2 rounded-md">Pelanggan</a></li>
                <li><a href="services.php" class="menu-item font-semibold text-gray-700 p-2 rounded-md">Layanan</a></li>
                <li><a href="transactions.php" class="menu-item font-semibold text-gray-700 p-2 rounded-md">Transaksi</a></li>
                <li><a href="logout.php" class="menu-item font-semibold text-red-600 p-2 rounded-md">Logout</a></li>
            </ul>
        </div>

        <!-- Konten Utama -->
        <div class="flex-1 p-6">
            <header class="bg-blue-700 text-white p-4 mb-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold">Selamat datang, <?php echo htmlspecialchars($user['name']); ?>!</h1>
                <p class="mt-2">Peran: <?php echo htmlspecialchars($user['role']); ?></p>
            </header>

            <main class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Dashboard Kasir</h2>
                <p class="mb-6">Di sini Anda dapat menginput pesanan pelanggan dan mengelola transaksi.</p>
                
                <section class="space-y-6">
                    <!-- Formulir Input Pesanan -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Input Pesanan Pelanggan</h3>
                        <form action="process_order.php" method="post">
                            <div class="mb-4">
                                <label for="customerName" class="block text-gray-700 font-medium mb-2">Nama Pelanggan</label>
                                <input type="text" id="customerName" name="customerName" class="w-full p-2 border border-gray-300 rounded-md" required>
                            </div>
                            <div class="mb-4">
                                <label for="service" class="block text-gray-700 font-medium mb-2">Layanan</label>
                                <select id="service" name="service" class="w-full p-2 border border-gray-300 rounded-md" required onchange="updatePrice()">
                                    <option value="">Pilih layanan</option>
                                    <option value="Cuci Kering">Cuci Kering</option>
                                    <option value="Cuci Setrika">Cuci Setrika</option>
                                    <option value="Seprei Kecil">Seprei Kecil</option>
                                    <option value="Seprei Besar">Seprei Besar</option>
                                    <option value="Selimut Kecil">Selimut Kecil</option>
                                    <option value="Selimut Besar">Selimut Besar</option>
                                    <option value="Cuci Boneka">Cuci Boneka</option>
                                    <option value="Cuci Sepatu">Cuci Sepatu</option>
                                </select>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="dateIn" class="block text-gray-700 font-medium mb-2">Tanggal Masuk</label>
                                    <input type="date" id="dateIn" name="dateIn" class="w-full p-2 border border-gray-300 rounded-md" required>
                                </div>
                                <div>
                                    <label for="estimatedCompletion" class="block text-gray-700 font-medium mb-2">Estimasi Selesai</label>
                                    <input type="date" id="estimatedCompletion" name="estimatedCompletion" class="w-full p-2 border border-gray-300 rounded-md" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="kilograms" class="block text-gray-700 font-medium mb-2">Kilogram</label>
                                <input type="number" id="kilograms" name="kilograms" class="w-full p-2 border border-gray-300 rounded-md" min="0" step="0.1" required onchange="updatePrice()">
                            </div>
                            <div class="mb-4">
                                <label for="price" class="block text-gray-700 font-medium mb-2">Harga</label>
                                <input type="text" id="price" name="price" class="w-full p-2 border border-gray-300 rounded-md" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="orderDetails" class="block text-gray-700 font-medium mb-2">Detail Pesanan</label>
                                <textarea id="orderDetails" name="orderDetails" rows="4" class="w-full p-2 border border-gray-300 rounded-md" required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Kirim Pesanan</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Statistik Pesanan -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Statistik Pesanan</h3>
                        <!-- Tambahkan statistik atau grafik pesanan di sini -->
                        <p>Menampilkan statistik pesanan terkini dan informasi penting lainnya.</p>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>
</html>
