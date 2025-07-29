<?php
session_start();
include 'koneksi_new.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $session_id = session_id();

    // Cek apakah produk sudah ada di keranjang
    $sql = "SELECT * FROM cart WHERE product_id = '$product_id' AND session_id = '$session_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Jika produk sudah ada, update quantity
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity;
        $update_sql = "UPDATE cart SET quantity = '$new_quantity' WHERE product_id = '$product_id' AND session_id = '$session_id'";
        $conn->query($update_sql);
    } else {
        // Jika produk belum ada, tambahkan ke keranjang
        $insert_sql = "INSERT INTO cart (product_id, product_name, product_price, quantity, session_id) VALUES ('$product_id', '$product_name', '$product_price', '$quantity', '$session_id')";
        $conn->query($insert_sql);
    }

    header("Location: view_cart.php");
    exit();
}
?>
