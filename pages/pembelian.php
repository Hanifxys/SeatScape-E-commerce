<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelian</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .header {
            color: #333;
            text-align: center;
            margin-top: 30px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th, .data-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .data-table th {
            background-color: #f2f2f2;
        }

        .action-button {
            text-decoration: none;
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .action-button:hover {
            background-color: #45a049;
        }
        
    </style>
</head>
<body>

<?php
$pdo = connectDB();

// Query untuk mengambil data pembelian dengan nama_pelanggan
$query = "SELECT pembelian.id_pembelian, pelanggan.nama_pelanggan, pembelian.tanggal_pembelian, pembelian.total_pembelian
          FROM pembelian
          JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan";
$stmt = $pdo->prepare($query);
$stmt->execute();
$pembelian = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1 class="header">Data Pembelian</h1>
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($pembelian as $pembelianItem) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>{$pembelianItem['nama_pelanggan']}</td>";
                echo "<td>{$pembelianItem['tanggal_pembelian']}</td>";
                echo "<td>{$pembelianItem['total_pembelian']}</td>";
                echo "<td><a href='index.php?page=detail_pembelian&id={$pembelianItem['id_pembelian']}' class='action-button'>Detail</a></td>";
                echo "</tr>";

                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
