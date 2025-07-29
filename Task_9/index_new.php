<?php include 'koneksi_new.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .filter-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .product-image {
            max-width: 80px; /* Atur lebar maksimum gambar */
            height: auto; /* Biarkan tinggi otomatis untuk menjaga proporsi */
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Data Produk</h2>

        <!-- Filter Section -->
        <div class="filter-section">
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Cari Produk:</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                </div>
                
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

        <a href="create.php" class="btn btn-primary mb-3">Tambah Produk</a>
        <a href="view_cart.php" class="btn btn-info mb-3">Lihat Keranjang</a>
        <a href="dashboardshop_new.php" class="btn btn-info mb-3">Back to Dashboard</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Stok</th>
                    <th>Gambar</th> <!-- Tambah kolom Gambar -->
                    <th>Pilih</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Bagian Filter Query
                $sql = "SELECT * FROM products WHERE 1=1";
                
                // Filter Pencarian
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $search = mysqli_real_escape_string($conn, $_GET['search']);
                    $sql .= " AND (name LIKE '%$search%' OR description LIKE '%$search%')";
                }
                
                // Filter Kategori
                if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
                    $kategori = mysqli_real_escape_string($conn, $_GET['kategori']);
                    $sql .= " AND kategori = '$kategori'";
                }
                
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>".htmlspecialchars($row['id'])."</td>
                                <td>".htmlspecialchars($row['name'])."</td>
                                <td>".htmlspecialchars($row['kategori'])."</td>
                                <td>".number_format($row['price'], 0, ',', '.')."</td>
                                <td>".htmlspecialchars($row['description'])."</td>
                                <td>".htmlspecialchars($row['stock'])."</td>
                                <td>";
                        // Tampilkan gambar jika ada
                        if (!empty($row['gambar']) && file_exists($row['gambar'])) {
                            echo '<img src="' . htmlspecialchars($row["gambar"]) . '" class="product-image" alt="' . htmlspecialchars($row["name"]) . '">';
                        } else {
                            echo "Tidak ada gambar";
                        }
                        echo "  </td>
                                <td>
                                    <a href='edit.php?id=".htmlspecialchars($row['id'])."' class='btn btn-warning'>Edit</a>
                                    <a href='delete.php?id=".htmlspecialchars($row['id'])."' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
