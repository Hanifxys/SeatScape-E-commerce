<?php
session_start();
include_once '../config.php';
$pdo = connectDB();

if (empty($_SESSION['keranjang']) || !isset($_SESSION['keranjang'])) {
    echo "<script>alert('Keranjang belanja kosong. Silahkan belanja dulu.');</script>";
    echo "<script>window.location='index.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/keranjang.css">
    <title>Keranjang Belanja</title>
</head>

<body>
<?php include '../Templates/navbar.php'; ?>

    <h2>Keranjang Belanja</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Harga</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $totalBelanja = 0;

            if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) {
                foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                    // Ambil data produk dari database berdasarkan ID
                    $stmt = $pdo->prepare("SELECT * FROM product WHERE id_product = :id_produk");
                    $stmt->bindParam(':id_produk', $id_produk);
                    $stmt->execute();
                    $produk = $stmt->fetch(PDO::FETCH_ASSOC);

                    $subHarga = $produk['harga_product'] * $jumlah;

                    // Tampilkan baris produk dalam tabel
                    echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td>{$produk['nama_product']}</td>";
                    echo "<td>Rp" . number_format($produk['harga_product'], 2) . "</td>";
                    echo "<td>$jumlah</td>";
                    echo "<td>Rp" . number_format($subHarga, 2) . "</td>";
                    echo "<td><a href='hapuskeranjang.php?id_produk=$id_produk'>Hapus</a></td>";
                    echo "</tr>";
                    

                
                    $totalBelanja += $subHarga;

                    $no++;
                }
            } else {
                echo "<tr><td colspan='5'>Keranjang belanja kosong</td></tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;">Total Belanja</td>
                <td>Rp<?php echo number_format($totalBelanja, 2); ?></td>
            </tr>
        </tfoot>
    </table>

    <a href="checkout.php" class="checkout-btn">Checkout</a>
    <a href="index.php" class="continue-shopping-btn">Lanjutkan Belanja</a>



</body>

</html>
