<?php
session_start();
include 'koneksi_new.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $session_id = session_id();

    $sql = "DELETE FROM cart WHERE product_id = '$product_id' AND session_id = '$session_id'";
    $conn->query($sql);
}

header("Location: view_cart.php");
exit();
?>
