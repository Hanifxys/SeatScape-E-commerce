<?php
$pdo = connectDB();

$id_produk = $_GET['id'];

// Ambil data produk
$query_produk = $pdo->prepare("SELECT * FROM product WHERE id_product = :id");
$query_produk->bindParam(':id', $id_produk);
$query_produk->execute();
$produk = $query_produk->fetch(PDO::FETCH_ASSOC);

// Edit produk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    try {
        // Update data produk berdasarkan input form
        $nama_produk = $_POST['nama'];
        $harga_produk = $_POST['harga'];
        $berat_produk = $_POST['berat'];
        $deskripsi_produk = $_POST['deskripsi'];

        // Jika ada file foto yang diunggah, proses foto
        if ($_FILES['foto']['name']) {
            // Hapus foto lama jika ada
            $foto_lama = $produk['foto_product'];
            if (file_exists($foto_lama)) {
                unlink($foto_lama);
            }

            // Pindahkan file yang diunggah ke folder uploads
            $foto_produk = 'uploads/' . $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], $foto_produk);
        } else {
            // Jika tidak ada file foto yang diunggah, gunakan foto lama
            $foto_produk = $produk['foto_product'];
        }

        // Query SQL untuk mengupdate produk
        $query_update = $pdo->prepare("UPDATE product SET 
                                        nama_product = :nama,
                                        harga_product = :harga,
                                        berat = :berat,
                                        foto_product = :foto,
                                        deskripsi_product = :deskripsi
                                      WHERE id_product = :id");
        $query_update->bindParam(':id', $id_produk);
        $query_update->bindParam(':nama', $nama_produk);
        $query_update->bindParam(':harga', $harga_produk);
        $query_update->bindParam(':berat', $berat_produk);
        $query_update->bindParam(':foto', $foto_produk);
        $query_update->bindParam(':deskripsi', $deskripsi_produk);
        $query_update->execute();

        echo "<script>alert('Produk berhasil diubah');</script>";
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
    <title>Edit Produk</title>
    <style>
 

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        img {
            width: 100px;
            height: auto;
            margin-bottom: 16px;
        }

        button {
            background-color: #0066cc;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0055a5;
        }
    </style>
</head>
<body>
    <h1>Edit Produk</h1>

    <!-- Form Edit Produk -->
    <form method="post" enctype="multipart/form-data">
        <label for="nama">Nama Produk:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $produk['nama_product']; ?>" required>
        <br>

        <label for="harga">Harga Produk:</label>
        <input type="text" id="harga" name="harga" value="<?php echo $produk['harga_product']; ?>" required>
        <br>

        <label for="berat">Berat Produk:</label>
        <input type="text" id="berat" name="berat" value="<?php echo $produk['berat']; ?>" required>
        <br>

        <label for="deskripsi">Deskripsi Produk:</label>
        <textarea id="deskripsi" name="deskripsi" required><?php echo $produk['deskripsi_product']; ?></textarea>
        <br>

        <label for="foto">Foto Produk:</label>
        <input type="file" id="foto" name="foto" accept="image/*">
        <br>

        <!-- Menampilkan foto produk -->
        <img src="<?php echo $produk['foto_product']; ?>" alt="Foto Produk">
        <br>

        <button type="submit" name="edit">Simpan Perubahan</button>
    </form>
</body>
</html>
