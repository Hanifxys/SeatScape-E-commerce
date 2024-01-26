<?php
require('../fpdf184/fpdf.php');
include_once '../config.php';
session_start();

$pdo = connectDB();

try {
    // Mengambil data pembelian terbaru
    $query_pembelian_terbaru = "SELECT pembelian.*, pelanggan.nama_pelanggan, pelanggan.telepon_pelanggan, pelanggan.email_pelanggan
                                FROM pembelian
                                JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan
                                ORDER BY pembelian.id_pembelian DESC
                                LIMIT 1";

    $stmt_pembelian_terbaru = $pdo->query($query_pembelian_terbaru);
    $detail_pembelian = $stmt_pembelian_terbaru->fetch(PDO::FETCH_ASSOC);

    if (!empty($detail_pembelian)) {
        // Membuat objek PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Menambahkan judul nota
        $pdf->Cell(0, 10, 'Nota Pembelian', 0, 1, 'C');
        $pdf->Ln(10);

        // Menambahkan informasi pembelian
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 10, 'ID Pembelian:', 0, 0);
        $pdf->Cell(0, 10, $detail_pembelian['id_pembelian'], 0, 1);
        $pdf->Cell(50, 10, 'Nama Pelanggan:', 0, 0);
        $pdf->Cell(0, 10, $detail_pembelian['nama_pelanggan'], 0, 1);
        $pdf->Cell(50, 10, 'No Telepon:', 0, 0);
        $pdf->Cell(0, 10, $detail_pembelian['telepon_pelanggan'], 0, 1);
        $pdf->Cell(50, 10, 'Email:', 0, 0);
        $pdf->Cell(0, 10, $detail_pembelian['email_pelanggan'], 0, 1);
        $pdf->Cell(50, 10, 'Tanggal Pembelian:', 0, 0);
        $pdf->Cell(0, 10, $detail_pembelian['tanggal_pembelian'], 0, 1);
        $pdf->Cell(50, 10, 'Total Pembelian:', 0, 0);
        $pdf->Cell(0, 10, 'Rp' . number_format($detail_pembelian['total_pembelian'], 2), 0, 1);
        $pdf->Ln(10);

        // Menambahkan rincian produk ke PDF
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Detail Produk', 0, 1, 'C');
        $pdf->Ln(5);

        $query_produk = "SELECT pr.nama_product, pr.harga_product, pb.jumlah, (pr.harga_product * pb.jumlah) AS subtotal
                        FROM pembelian_product pb
                        JOIN product pr ON pb.id_product = pr.id_product
                        WHERE pb.id_pembelian = :id_pembelian";

        $stmt_produk = $pdo->prepare($query_produk);
        $stmt_produk->bindParam(':id_pembelian', $detail_pembelian['id_pembelian'], PDO::PARAM_INT);
        $stmt_produk->execute();

        $detail_produk = $stmt_produk->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($detail_produk)) {
            // Menambahkan header tabel produk
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(40, 10, 'Nama Product', 1);
            $pdf->Cell(30, 10, 'Harga Product', 1);
            $pdf->Cell(20, 10, 'Jumlah', 1);
            $pdf->Cell(40, 10, 'Subtotal', 1);
            $pdf->Ln();

            // Menambahkan data produk ke dalam tabel
            $pdf->SetFont('Arial', '', 10);
            foreach ($detail_produk as $produk) {
                $pdf->Cell(40, 10, $produk['nama_product'], 1);
                $pdf->Cell(30, 10, 'Rp' . number_format($produk['harga_product'], 2), 1);
                $pdf->Cell(20, 10, $produk['jumlah'], 1);
                $pdf->Cell(40, 10, 'Rp' . number_format($produk['subtotal'], 2), 1);
                $pdf->Ln();
            }
        } else {
            $pdf->Cell(0, 10, 'Tidak ada data pembelian produk.', 0, 1);
        }

        // Menyimpan atau menampilkan PDF di browser
        $pdf->Output('Nota_' . $detail_pembelian['id_pembelian'] . '.pdf', 'D');
    } else {
        echo 'Data pembelian tidak ditemukan.';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
