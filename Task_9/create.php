FileName: MultipleFiles/create.php
FileContents: <?php include 'koneksi_new.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Produk Baru</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nama_produk = $_POST['name'];
            $kategori = $_POST['kategori'];
            $harga = $_POST['price'];
            $description = $_POST['description'];
            $stok = $_POST['stock'];
            $image_path = $_POST['gambar']; // Inisialisasi jalur gambar

            // Tangani unggahan gambar
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
                $target_dir = "picture_product/";
                // Pastikan direktori uploads ada
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $uploadOk = 1;

                // Cek apakah file gambar asli atau palsu
                $check = getimagesize($_FILES["gambar"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "<div class='alert alert-danger'>File bukan gambar.</div>";
                    $uploadOk = 0;
                }

                // Cek ukuran file
                if ($_FILES["gambar"]["size"] > 5000000) { // 5MB
                    echo "<div class='alert alert-danger'>Maaf, ukuran file terlalu besar.</div>";
                    $uploadOk = 0;
                }

                // Izinkan format file tertentu
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "<div class='alert alert-danger'>Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.</div>";
                    $uploadOk = 0;
                }

                // Cek jika $uploadOk adalah 0 karena ada error
                if ($uploadOk == 0) {
                    echo "<div class='alert alert-danger'>Maaf, file Anda tidak terunggah.</div>";
                } else {
                    // Jika semuanya OK, coba unggah file
                    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                        $image_path = $target_file; // Simpan jalur relatif
                    } else {
                        echo "<div class='alert alert-danger'>Maaf, terjadi kesalahan saat mengunggah file Anda.</div>";
                    }
                }
            }
            
            // Pastikan kolom di database sesuai dengan urutan di query
            // Tambahkan 'image_path' ke query INSERT
            $stmt = $conn->prepare("INSERT INTO products (id, name, kategori, price, description, stock, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)");
            // Tipe data: s (id), s (name), s (kategori), d (price), s (description), i (stock), s (gambar)
            $stmt->bind_param("sssdsis", $id, $nama_produk, $kategori, $harga, $description, $stok, $image_path);
            
            if($stmt->execute()) {
                header("Location: index_new.php?pesan=create_success");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }
            $stmt->close();
        }
        ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="id" class="form-label">ID Produk</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Produk</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index_new.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
