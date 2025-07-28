FileName: MultipleFiles/edit.php
FileContents: <?php
include 'koneksi.php';

$row = null; // Inisialisasi $row

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='alert alert-danger'>Produk tidak ditemukan.</div>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nama_produk = mysqli_real_escape_string($conn, $_POST['name']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $harga = (float)$_POST['price'];
    $stok = (int)$_POST['stock'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $current_image_path = mysqli_real_escape_string($conn, $_POST['gambar']); // Ambil jalur gambar saat ini

    $image_path = $current_image_path; // Default ke jalur gambar yang sudah ada

    // Tangani unggahan gambar baru
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $target_dir = "picture_product/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;

        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<div class='alert alert-danger'>File bukan gambar.</div>";
            $uploadOk = 0;
        }

        if ($_FILES["gambar"]["size"] > 5000000) { // 5MB
            echo "<div class='alert alert-danger'>Maaf, ukuran file terlalu besar.</div>";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "<div class='alert alert-danger'>Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.</div>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "<div class='alert alert-danger'>Maaf, file baru Anda tidak terunggah.</div>";
        } else {
            // Hapus gambar lama jika ada dan gambar baru berhasil diunggah
            if (!empty($current_image_path) && file_exists($current_image_path)) {
                unlink($current_image_path);
            }
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $image_path = $target_file; // Perbarui jalur gambar
            } else {
                echo "<div class='alert alert-danger'>Maaf, terjadi kesalahan saat mengunggah file baru Anda.</div>";
            }
        }
    }
    
    // Perbarui query UPDATE untuk menyertakan image_path
    $stmt = $conn->prepare("UPDATE products SET name=?, kategori=?, price=?, description=?, stock=?, gambar=? WHERE id=?");
    // Tipe data: s (name), s (kategori), d (price), s (description), i (stock), s (gambar), s (id)
    $stmt->bind_param("ssdsiss", $nama_produk, $kategori, $harga, $description, $stok, $image_path, $id);
    
    if($stmt->execute()) {
        header("Location: index.php?pesan=update_success");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Produk</h2>
        
        <?php if ($row): ?>
        <form action="edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
            <input type="hidden" name="current_image_path" value="<?php echo htmlspecialchars($row['gambar']); ?>">
            
            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" class="form-control" name="name" 
                       value="<?php echo htmlspecialchars($row['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" class="form-control" name="kategori" 
                       value="<?php echo htmlspecialchars($row['kategori']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" class="form-control" name="price" step="0.01"
                       value="<?php echo htmlspecialchars($row['price']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" class="form-control" name="stock" 
                       value="<?php echo htmlspecialchars($row['stock']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="description"><?php echo htmlspecialchars($row['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Produk</label>
                <?php if (!empty($row['gambar']) && file_exists($row['gambar'])): ?>
                    <div class="mb-2">
                        <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar Produk" style="max-width: 150px; height: auto;">
                        <small class="form-text text-muted">Gambar saat ini</small>
                    </div>
                <?php endif; ?>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <small class="form-text text-muted">Pilih gambar baru jika ingin mengubah.</small>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
        <?php else: ?>
            <div class="alert alert-warning">Data produk tidak ditemukan atau ID tidak valid.</div>
            <a href="index.php" class="btn btn-secondary">Kembali ke Daftar Produk</a>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
