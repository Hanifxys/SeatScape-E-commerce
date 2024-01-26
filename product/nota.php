<?php
session_start();
include_once '../config.php';
$pdo = connectDB();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f6f8; /* Light Grayish Blue */
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .header {
            background-color: #007bff; /* Tokopedia Blue */
            color: #ffffff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 1.8em;
        }

        .main-content {
            padding: 20px;
        }

        .additional-info {
            margin-bottom: 15px;
            color: #555;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .product-table th,
        .product-table td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        .product-table th {
            background-color: #007bff; /* Tokopedia Blue */
            color: #ffffff;
        }

        .total-section {
            text-align: right;
            margin-top: 20px;
            font-size: 1.2em;
        }

        .actions-section {
            text-align: center;
            margin-top: 20px;
        }

        .action-button {
            background-color: #007bff; /* Tokopedia Blue */
            color: #ffffff;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            margin: 0 15px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .action-button:hover {
            background-color: #0056b3; /* Darker shade of Tokopedia Blue */
        }

        .after-transfer {
            margin-top: 30px;
            background: linear-gradient(to right, #007bff, #0056b3); /* Tokopedia Blue Gradient */
            color: #ffffff;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            transition: background 0.3s ease;
        }

        .after-transfer a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .after-transfer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php include '../Templates/navbar.php' ?>

    <div class="container">

        <?php
        $id_pembelian = isset($_GET['id']) ? intval($_GET['id']) : null;

        if ($id_pembelian !== null) {
            $pdo = connectDB();

            try {
                $query_pembelian = "SELECT pembelian.*, pelanggan.nama_pelanggan, pelanggan.telepon_pelanggan, pelanggan.email_pelanggan
                                FROM pembelian
                                JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan
                                WHERE pembelian.id_pembelian = :id_pembelian";

                $stmt_pembelian = $pdo->prepare($query_pembelian);
                $stmt_pembelian->bindParam(':id_pembelian', $id_pembelian, PDO::PARAM_INT);
                $stmt_pembelian->execute();

                $detail_pembelian = $stmt_pembelian->fetch(PDO::FETCH_ASSOC);

                echo '<div class="header">';
                echo '<h1>Detail Pembelian</h1>';
                echo '</div>';

                if (!empty($detail_pembelian)) {
                    echo '<div class="main-content">';
                    echo '<p class="additional-info">Nama Pelanggan: ' . $detail_pembelian['nama_pelanggan'] . '</p>';
                    echo '<p class="additional-info">No Telepon: ' . $detail_pembelian['telepon_pelanggan'] . '</p>';
                    echo '<p class="additional-info">Email: ' . $detail_pembelian['email_pelanggan'] . '</p>';
                    echo '<p class="additional-info">Tanggal Pembelian: ' . $detail_pembelian['tanggal_pembelian'] . '</p>';
                    echo '<p class="additional-info">Total Pembelian: Rp' . number_format($detail_pembelian['total_pembelian'], 2) . '</p>';

                    $query_produk = "SELECT pr.nama_product, pr.harga_product, pb.jumlah, (pr.harga_product * pb.jumlah) AS subtotal
                                FROM pembelian_product pb
                                JOIN product pr ON pb.id_product = pr.id_product
                                WHERE pb.id_pembelian = :id_pembelian";

                    $stmt_produk = $pdo->prepare($query_produk);
                    $stmt_produk->bindParam(':id_pembelian', $id_pembelian, PDO::PARAM_INT);
                    $stmt_produk->execute();

                    $detail_produk = $stmt_produk->fetchAll(PDO::FETCH_ASSOC);

                    echo '<table class="product-table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Nama Product</th>';
                    echo '<th>Harga Product</th>';
                    echo '<th>Jumlah</th>';
                    echo '<th>Subtotal</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    if (!empty($detail_produk)) {
                        foreach ($detail_produk as $produk) {
                            echo '<tr>';
                            echo '<td>' . $produk['nama_product'] . '</td>';
                            echo '<td>Rp' . number_format($produk['harga_product'], 2) . '</td>';
                            echo '<td>' . $produk['jumlah'] . '</td>';
                            echo '<td>Rp' . number_format($produk['subtotal'], 2) . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">Tidak ada data pembelian produk.</td></tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';

                    echo '<p class="additional-info">Silahkan melakukan pembayaran Rp. ' . number_format($detail_pembelian['total_pembelian'], 2) . ' ke <br>';
                    echo '<strong>BANK MANDIRI 122-000222-2435 AN. HANIF </strong></p>';

                    // Text after transfer
                    echo '<div class="after-transfer">';
                    echo '<p>Setelah melakukan transfer, tolong konfirmasi melalui <a href="https://wa.me/085775491304?text=silahkan%20kirimkan%20bukti%20transfernya" target="_blank">link WhatsApp</a>.</p>';
                    echo '</div>';

                    echo '<div class="actions-section">';
                    echo '<a href="cetak.php?id=' . $id_pembelian . '" target="_blank" class="action-button">Cetak Nota</a>';
                    echo '</div>';

                    echo '</div>';
                } else {
                    echo '<p class="main-h1">ID Pembelian tidak valid atau data tidak ditemukan.</p>';
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo '<h1 class="main-h1">ID Pembelian tidak valid.</h1>';
        }

        // Mengecek apakah pembelian berhasil sebelum melakukan pengalihan
        if (isset($id_pembelian_barusan)) {
            echo 'Pembelian berhasil! ID Pembelian: ' . $id_pembelian_barusan;
            header("Location: nota.php?id=$id_pembelian_barusan");
            exit;
        }
        ?>

    </div>

    <!-- (Tambahkan tag penutup untuk HTML) -->
</body>

</html>
