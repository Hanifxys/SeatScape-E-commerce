<?php
$pdo = connectDB();

// Query untuk mengambil data pelanggan
$query = "SELECT * FROM pelanggan";
$stmt = $pdo->prepare($query);
$stmt->execute();
$pelanggan = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
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

        .delete-button {
            text-decoration: none;
            padding: 8px 15px;
            background-color: #e74c3c;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="header">Data Pelanggan</h1>
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($pelanggan as $pelangganItem) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>{$pelangganItem['nama_pelanggan']}</td>";
                echo "<td>{$pelangganItem['email_pelanggan']}</td>";
                echo "<td>{$pelangganItem['telepon_pelanggan']}</td>";
                echo "<td><a href='index.php?page=hapus_pelanggan&id={$pelangganItem['id_pelanggan']}' class='delete-button'>Hapus</a></td>";
                echo "</tr>";

                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
