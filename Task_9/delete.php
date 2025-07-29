FileName: MultipleFiles/delete.php
FileContents: <?php
include 'koneksi_new.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil jalur gambar sebelum menghapus produk dari database
    $sql_select_image = "SELECT gambar FROM products WHERE id = '$id'"; // Mengubah dari 'produk' ke 'products'
    $result_image = mysqli_query($conn, $sql_select_image);
    
    if ($result_image && mysqli_num_rows($result_image) > 0) {
        $row_image = mysqli_fetch_assoc($result_image);
        $image_to_delete = $row_image['gambar'];
        
        // Hapus file gambar fisik jika ada
        if (!empty($image_to_delete) && file_exists($image_to_delete)) {
            if (unlink($image_to_delete)) {
                // echo "Gambar berhasil dihapus: " . $image_to_delete . "<br>";
            } else {
                // echo "Gagal menghapus gambar: " . $image_to_delete . "<br>";
            }
        }
    }

    // Hapus entri produk dari database
    $sql = "DELETE FROM products WHERE id = '$id'"; // Mengubah dari 'produk' ke 'products'
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index_new.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
