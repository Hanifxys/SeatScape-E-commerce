<?php


// Cari dan hapus data di tabel pembelian terlebih dahulu
$pdo = connectDB();
$id_pelanggan_hapus = $_GET['id'];

// Query untuk mencari dan menghapus data di tabel pembelian terkait
$query_hapus_pembelian = "DELETE FROM pembelian WHERE id_pelanggan = :id_pelanggan";
$stmt_hapus_pembelian = $pdo->prepare($query_hapus_pembelian);
$stmt_hapus_pembelian->bindParam(':id_pelanggan', $id_pelanggan_hapus, PDO::PARAM_INT);

// Eksekusi query
$stmt_hapus_pembelian->execute();

// Setelah itu, baru hapus data di tabel pelanggan
$query_hapus_pelanggan = "DELETE FROM pelanggan WHERE id_pelanggan = :id_pelanggan";
$stmt_hapus_pelanggan = $pdo->prepare($query_hapus_pelanggan);
$stmt_hapus_pelanggan->bindParam(':id_pelanggan', $id_pelanggan_hapus, PDO::PARAM_INT);

// Eksekusi query
if ($stmt_hapus_pelanggan->execute()) {
    echo "Pelanggan dengan ID $id_pelanggan_hapus berhasil dihapus.";
} else {
    echo "Gagal menghapus pelanggan.";
}
