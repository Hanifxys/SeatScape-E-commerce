<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $berat = $_POST['berat'];
    $deskripsi = $_POST['deskripsi'];
    $foto = $_FILES['foto'];

    // Validasi form
    if (empty($nama) || empty($harga) || empty($berat) || empty($deskripsi) || empty($foto['name'])) {
        echo 'Semua kolom harus diisi.';
        exit;
    }

    // Pindahkan file yang diunggah ke folder uploads
    $fotoPath = 'uploads/' . $foto['name'];
    move_uploaded_file($foto['tmp_name'], $fotoPath);

    try {
        $pdo = connectDB();

        // Query SQL untuk menyimpan data produk
        $query = "INSERT INTO product (nama_product, harga_product, berat, foto_product, deskripsi_product) 
                  VALUES (:nama, :harga, :berat, :foto, :deskripsi)";

        // Persiapkan dan jalankan statement
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':nama' => $nama,
            ':harga' => $harga,
            ':berat' => $berat,
            ':foto' => $fotoPath,
            ':deskripsi' => $deskripsi,
        ]);

        echo 'Produk berhasil disimpan!';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Simpan Produk</title>
    <style>


        h1 {
            color: #333;
            text-align: center;
        }

        form {
            width: 410px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        form {
    width: 400px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: auto; /* Added to center the form */
    display: flex;
    flex-direction: column;
    align-items: center;
}


        textarea {
            resize: vertical;
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
    <h1>Form Simpan Produk</h1>
    
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama">Nama Produk:</label>
        <input type="text" id="nama" name="nama" required>
        
        <label for="harga">Harga Produk:</label>
        <input type="text" id="harga" name="harga" required>
        
        <label for="berat">Berat Produk:</label>
        <input type="text" id="berat" name="berat" required>
        
        <label for="deskripsi">Deskripsi Produk:</label>
        <textarea id="deskripsi" name="deskripsi" required></textarea>
        
        <label for="foto">Foto Produk:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required>
        
        <button type="submit" name="simpan">Simpan</button>
    </form>
</body>
</html>
