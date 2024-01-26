<?php
$pdo = connectDB();

// Query untuk mengambil data produk
$query = "SELECT * FROM product";
$stmt = $pdo->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .header {
            color: #333;
            text-align: center;
            margin-top: 30px;
        }

        .data-table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .data-table th, .data-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .data-table th {
            background-color: #f2f2f2;
        }

        .product-image {
            max-width: 100px;
            height: auto;
            display: block;
            margin: auto;
            border-radius: 5px;
        }

        .edit-button, .delete-button {
            text-decoration: none;
            padding: 8px 15px;
            margin-right: 10px;
            border: 1px solid #4CAF50;
            color: #4CAF50;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .edit-button:hover, .delete-button:hover {
            background-color: #4CAF50;
            color: white;
        }

        .add-button {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Data Produk</h1>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Foto Produk</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($products as $product) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$product['nama_product']}</td>";
            echo "<td>{$product['harga_product']}</td>";
            echo "<td>{$product['berat']}</td>";
            echo "<td><img src='{$product['foto_product']}' alt='Foto Produk' class='product-image'></td>";
            echo "<td>{$product['deskripsi_product']}</td>";
            echo "<td><a href='index.php?page=edit_product&id={$product['id_product']}' class='edit-button'>Edit</a><a href='index.php?page=hapus_product&id={$product['id_product']}' class='delete-button'>Hapus</a></td>";
            echo "</tr>";

            $no++;
        }
        ?>
    </tbody>
</table>

<div class="add-button">
    <a href="index.php?page=tambah_product" class="edit-button">Tambah Data</a>
</div>

</body>
</html>
