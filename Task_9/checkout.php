<?php
session_start();
include 'koneksi_new.php';

$session_id = session_id();
$sql = "SELECT * FROM cart WHERE session_id = '$session_id'";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Proses checkout
    // Di sini Anda bisa menambahkan logika untuk menyimpan pesanan ke database
    // Misalnya, menyimpan ke tabel orders

    // Hapus keranjang setelah checkout
    $delete_sql = "DELETE FROM cart WHERE session_id = '$session_id'";
    $conn->query($delete_sql);

    echo "<div class='container mt-5'><h1 class='text-center'>Terima kasih! Pesanan Anda telah diproses.</h1></div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Checkout</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div>
                <label for= "number" class="form-label"> No. Telepon (WA)</label>
                <input type="number" class="form-control" id="number" name="number" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat Pengiriman</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Konfirmasi Pesanan</button>
            <a href="view_cart.php" class="btn btn-secondary">Kembali ke Keranjang</a>
        </form>
    </div>
</body>
</html>
