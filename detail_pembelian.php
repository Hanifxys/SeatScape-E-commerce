

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Seatscape/css/nota.css">
    <title>Nota</title>


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

        echo '<h1>Detail Pembelian</h1>';
        if (!empty($detail_pembelian)) {
            echo '<p>Nama Pelanggan: ' . $detail_pembelian['nama_pelanggan'] . '</p>';
            echo '<p>No Telepon: ' . $detail_pembelian['telepon_pelanggan'] . '</p>';
            echo '<p>Email: ' . $detail_pembelian['email_pelanggan'] . '</p>';
            echo '<p>Tanggal Pembelian: ' . $detail_pembelian['tanggal_pembelian'] . '</p>';
            echo '<p>Total Pembelian: Rp' . number_format($detail_pembelian['total_pembelian'], 2) . '</p>';

            $query_produk = "SELECT pr.nama_product, pr.harga_product, pb.jumlah, (pr.harga_product * pb.jumlah) AS subtotal
                            FROM pembelian_product pb
                            JOIN product pr ON pb.id_product = pr.id_product
                            WHERE pb.id_pembelian = :id_pembelian";

            $stmt_produk = $pdo->prepare($query_produk);
            $stmt_produk->bindParam(':id_pembelian', $id_pembelian, PDO::PARAM_INT);
            $stmt_produk->execute();

            $detail_produk = $stmt_produk->fetchAll(PDO::FETCH_ASSOC);

            echo '<table>';
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

        } else {
            echo '<p>ID Pembelian tidak valid atau data tidak ditemukan.</p>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo '<h1>ID Pembelian tidak valid.</h1>';
}


?>

<!-- (Tambahkan tag penutup untuk HTML) -->
</body>
</html>
