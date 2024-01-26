<?php
// Hapus produk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus'])) {
    try {
        $pdo = connectDB();

        // Ambil ID produk dari parameter URL
        $id_produk = $_GET['id'];

        // Query SQL untuk menghapus produk
        $query_hapus = $pdo->prepare("SELECT * FROM product WHERE id_product = :id");
        $query_hapus->bindParam(':id', $id_produk);
        $query_hapus->execute();

        // Ambil data produk
        $produk = $query_hapus->fetch(PDO::FETCH_ASSOC);

        // Hapus foto produk jika ada
        $foto_produk = $produk['foto_product'];
        if (file_exists($foto_produk)) {
            unlink($foto_produk);
        }

        // Query SQL untuk menghapus produk dari database
        $query_delete = $pdo->prepare("DELETE FROM product WHERE id_product = :id");
        $query_delete->bindParam(':id', $id_produk);
        $query_delete->execute();

        echo "<script>alert('Produk berhasil dihapus');</script>";
        echo "<script>location='index.php?page=produk';</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Produk</title>
</head>
<body>
    <h1>Hapus Produk</h1>

    <?php
    // Ambil ID produk dari parameter URL
    $id_produk = $_GET['id'];

    // Tampilkan konfirmasi hapus
    echo "<p>Anda yakin ingin menghapus produk dengan ID: $id_produk?</p>";

    // Tampilkan form konfirmasi
    echo "<form method='post'>";
    echo "<button type='submit' name='hapus'>Hapus</button>";
    echo "</form>";
    ?>
</body>
</html>