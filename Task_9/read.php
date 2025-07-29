FileName: MultipleFiles/read.php
FileContents: <?php
include 'koneksi_new.php';

$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM products";
$conditions = [];

if ($kategori) {
    $conditions[] = "kategori = '" . mysqli_real_escape_string($conn, $kategori) . "'";
}

if ($search) {
    $conditions[] = "(name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%' 
                     OR description LIKE '%" . mysqli_real_escape_string($conn, $search) . "%')";
}

if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .filter-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .product-image {
            max-width: 80px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Daftar Produk</h1>
        
        <div class="filter-section">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Produk:</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" placeholder="Nama atau Deskripsi">
                </div>
                <div class="col-md-4">
                    <label for="kategori" class="form-label">Kategori:</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option value="">Semua Kategori</option>
                        <?php
                        $sqlKategori = "SELECT DISTINCT kategori FROM products";
                        $resultKategori = mysqli_query($conn, $sqlKategori);
                        while($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                            $selected = (isset($_GET['kategori']) && $_GET['kategori'] == $rowKategori['kategori']) ? 'selected' : '';
                            echo "<option value='{$rowKategori['kategori']}' $selected>{$rowKategori['kategori']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="read.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>

        <a href="create.php" class="btn btn-success mb-3">Tambah Produk Baru</a>
        
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Stok</th>
                    <th>Gambar</th> <!-- Tambah kolom Gambar -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['name']."</td>
                            <td>".$row['kategori']."</td>
                            <td>Rp ".number_format($row['price'], 0, ',', '.')."</td>
                            <td>".$row['description']."</td>
                            <td>".$row['stock']."</td>
                            <td>";
                        // Tampilkan gambar jika ada
                        if (!empty($row['gambar']) && file_exists($row['gambar'])) {
                            echo "<img src='".htmlspecialchars($row['gambar'])."' alt='".htmlspecialchars($row['name'])."' class='product-image'>";
                        } else {
                            echo "Tidak ada gambar";
                        }
                        echo "  </td>
                            <td>
                                <a href='edit.php?id=".$row['id']."' class='btn btn-sm btn-warning'>Edit</a> | 
                                <a href='delete.php?id=".$row['id']."' class='btn btn-sm btn-danger' onclick='return confirm(\"Hapus produk ini?\")'>Hapus</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Tidak ada produk</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
