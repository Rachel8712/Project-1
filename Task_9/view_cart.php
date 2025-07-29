<?php
session_start();
include 'koneksi_new.php';

$session_id = session_id();
$sql = "SELECT * FROM cart WHERE session_id = '$session_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Keranjang Belanja</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $subtotal = $row['product_price'] * $row['quantity'];
                        $total += $subtotal;
                        echo "<tr>
                                <td>{$row['product_name']}</td>
                                <td>Rp " . number_format($row['product_price'], 0, ',', '.') . "</td>
                                <td>{$row['quantity']}</td>
                                <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
                                <td>
                                    <form action='remove_from_cart.php' method='POST' class='d-inline'>
                                        <input type='hidden' name='product_id' value='{$row['product_id']}'>
                                        <button type='submit' class='btn btn-danger btn-sm'>Hapus</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Keranjang kosong.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <h3>Total: Rp <?php echo number_format($total, 0, ',', '.'); ?></h3>
        <a href="checkout.php" class="btn btn-success">Checkout</a>
        <a href="dashboardshop_new.php" class="btn btn-secondary">Kembali ke Belanja</a>
    </div>
</body>
</html>
