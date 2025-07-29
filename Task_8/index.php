<?php 
// Memasukkan file koneksi
include 'koneksi.php';

// Ambil semua kategori unik dari database
$sqlCategories = "SELECT DISTINCT kategori FROM products";
$resultCategories = $conn->query($sqlCategories);

$categories = [];
if ($resultCategories->num_rows > 0) {
    while($row = $resultCategories->fetch_assoc()) {
        $categories[] = $row['kategori'];
    }
}

// Filter produk berdasarkan kategori jika ada parameter
$categoryFilter = isset($_GET['kategori']) ? $_GET['kategori'] : 'all';
$sqlProducts = "SELECT * FROM products";
if ($categoryFilter && $categoryFilter != 'all') {
    $sqlProducts .= " WHERE kategori = '" . $conn->real_escape_string($categoryFilter) . "'";
}
$resultProducts = $conn->query($sqlProducts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adelysia Coffee Shop - Daftar Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
        }
        .card {
            transition: transform 0.3s;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .product-price {
            color: #0d6efd;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .filter-container {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        .filter-btn {
            border-radius: 20px;
            padding: 8px 15px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Navbar Brand Saja -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Adelysia Coffee Shop</a>
            </div>
        </nav>
    </div>

    <div class="container">
        <h1 class="text-center mb-4">Daftar Produk</h1>
        
       <!-- Filter Section -->
       <div class="filter-section">
            <form method="GET" class="row g-3">
        
                <div class="col-md-3">
                    <label for="kategori" class="form-label">Kategori:</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option value="">Semua Kategori</option>
                        <?php
                        // Ambil kategori unik dari database
                        $sqlKategori = "SELECT DISTINCT kategori FROM products";
                        $resultKategori = mysqli_query($conn, $sqlKategori);
                        while($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                            $selected = (isset($_GET['kategori']) && $_GET['kategori'] == $rowKategori['kategori']) ? 'selected' : '';
                            echo "<option value='{$rowKategori['kategori']}' $selected>{$rowKategori['kategori']}</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="index.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>

        <div class="row">
            <?php
            if ($resultProducts->num_rows > 0) {
                while($row = $resultProducts->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card">';
                    echo '<img src="' . $row["gambar"] . '" class="card-img-top" alt="' . $row["name"] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                    echo '<p class="card-text text-muted">' . $row["kategori"] . '</p>';
                    echo '<p class="card-text">' . $row["description"] . '</p>';
                    echo '<p class="product-price">Rp ' . number_format($row["price"], 0, ',', '.') . '</p>';
                    echo '<a href="#" class="btn btn-primary">Beli Sekarang</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12"><p class="text-center">Tidak ada produk.</p></div>';
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
