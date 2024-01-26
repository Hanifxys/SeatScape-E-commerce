<?php
session_start();
include_once '../config.php';
$pdo = connectDB();

if (!isset($_SESSION['id_pelanggan'])) {
    echo "<script>alert('Silahkan login');</script>";
    echo "<script>location='login.php';</script>";
}

if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
 {
 echo "<script>alert('Keranjang Kosong, silahkan belanja');</script>";
 echo "<script>location='index.php';</script>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/checkout.css">
  
</head>

<body>
 <?php include '../Templates/navbar.php' ?>

    <h2>Checkout belanja</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Harga</th>
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

                    // Hitung subtotal
                    $subHarga = $produk['harga_product'] * $jumlah;

                    // Tampilkan baris produk dalam tabel
                    echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td>{$produk['nama_product']}</td>";
                    echo "<td>Rp" . number_format($produk['harga_product'], 2) . "</td>";
                    echo "<td>$jumlah</td>";
                    echo "<td>Rp" . number_format($subHarga, 2) . "</td>";
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

    <form method="post">
        <input type="text" readonly value="<?php echo isset($_SESSION['nama_pelanggan']) ? $_SESSION['nama_pelanggan'] : ''; ?>" class="form-control">
        <input type="text" readonly value="<?php echo isset($_SESSION['telepon_pelanggan']) ? $_SESSION['telepon_pelanggan'] : ''; ?>" class="form-control">
        <input type="text" readonly value="<?php echo isset($_SESSION['email_pelanggan']) ? $_SESSION['email_pelanggan'] : ''; ?>" class="form-control">

        <select class="form-control" name="id_ongkir">
            <option value="pilih" selected>Pilih ongkos kirim</option>
            <?php
            $ambil = $pdo->prepare("SELECT * FROM ongkir");
            $ambil->execute();

            while ($perongkir = $ambil->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option value="<?php echo $perongkir['id_ongkir']; ?>">
                    <?php echo $perongkir['nama_kota']; ?> - Rp. <?php echo number_format($perongkir['tarif']); ?>
                </option>
            <?php
            }
            ?>
        </select>
        <button type="submit" name="checkout" class="checkout-btn">Checkout</button>
    </form>
    <?php
    if (isset($_POST["checkout"])) {
        $id_pelanggan = $_SESSION['id_pelanggan'];
        $id_ongkir = $_POST['id_ongkir'];
        $tanggal_pembelian = date("Y-m-d");

       
        $ambil_ongkir = $pdo->prepare("SELECT * FROM ongkir WHERE id_ongkir = :id_ongkir");
        $ambil_ongkir->bindParam(':id_ongkir', $id_ongkir, PDO::PARAM_INT);
        $ambil_ongkir->execute();
        $array_ongkir = $ambil_ongkir->fetch(PDO::FETCH_ASSOC);

        if ($array_ongkir) {
            $tarif = $array_ongkir['tarif'];
            $total_pembelian = $totalBelanja + $tarif;

            // Insert into pembelian table
            $insert_pembelian = $pdo->prepare("INSERT INTO pembelian (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian) VALUES (:id_pelanggan, :id_ongkir, :tanggal_pembelian, :total_pembelian)");
            $insert_pembelian->bindParam(':id_pelanggan', $id_pelanggan, PDO::PARAM_INT);
            $insert_pembelian->bindParam(':id_ongkir', $id_ongkir, PDO::PARAM_INT);
            $insert_pembelian->bindParam(':tanggal_pembelian', $tanggal_pembelian, PDO::PARAM_STR);
            $insert_pembelian->bindParam(':total_pembelian', $total_pembelian, PDO::PARAM_INT);
    

            if ($insert_pembelian->execute()) {
                $id_pembelian_barusan = $pdo->lastInsertId();

                foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
                    // Insert into pembelian_produk table
                    $insert_produk = $pdo->prepare("INSERT INTO pembelian_product (id_pembelian, id_product, jumlah) VALUES (:id_pembelian, :id_product, :jumlah)");
                    $insert_produk->bindParam(':id_pembelian', $id_pembelian_barusan, PDO::PARAM_INT);
                    $insert_produk->bindParam(':id_product', $id_produk, PDO::PARAM_INT);
                    $insert_produk->bindParam(':jumlah', $jumlah, PDO::PARAM_INT);
                    $insert_produk->execute();
                }

                unset($_SESSION['keranjang']);

                echo '<script>alert("Pembelian berhasil! ID Pembelian: ' . $id_pembelian_barusan . '");</script>';
                echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
                exit();
            } else {
                echo '<script>alert("Error: Gagal melakukan pembelian.");</script>';
            }
        } else {
            echo '<script>alert("Error: Ongkir data not found.");</script>';
        }
    }
    ?>

   

</body>

</html>
