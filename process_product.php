<?php
// Data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Ambil data dari form
    $nama = htmlspecialchars(trim($_POST['nama']));
    $harga = htmlspecialchars(trim($_POST['harga']));
    $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));

    // Validasi
    if (empty($nama) || empty($harga)) {
        echo 'Nama dan Harga harus diisi';
        exit;
    }

    // Menampilkan data yang diterima
    echo "<h1>Form Produk Diterima</h1>";
    echo "<p><strong>Nama Produk:</strong> $nama</p>";
    echo "<p><strong>Harga Produk:</strong> $harga</p>";
    echo "<p><strong>Deskripsi Produk:</strong><br>" . nl2br($deskripsi) . "</p>";
} else {
    echo "Tidak ada data yang diterima.";
}
?>
