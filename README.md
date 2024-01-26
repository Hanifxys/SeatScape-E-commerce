# Seatscape E-Commerce Project

## Deskripsi Proyek

Seatscape E-Commerce adalah proyek yang bertujuan untuk mengembangkan platform perdagangan elektronik (e-commerce) untuk penjualan kursi dan produk terkait. Proyek ini mencakup modul admin dan user yang memungkinkan pengguna untuk melakukan operasi CRUD (Create, Read, Update, Delete), serta kemampuan untuk menghasilkan dan mengunduh nota pembelian.

## Fitur

### Modul Admin
1. **Manajemen Produk**
   - Menambah, mengedit, dan menghapus produk.
   - Menampilkan daftar produk dengan informasi rinci.

2. **Manajemen Pelanggan**
   - Menampilkan daftar pelanggan.
   - Melihat informasi pelanggan.

3. **Manajemen Pembelian**
   - Melihat daftar pembelian yang dilakukan oleh pelanggan.
   - Mengelola status pembelian.

### Modul User
1. **pelanggan bisa login register dengan nyaman karena menggunakan cokkie**
   - Pengguna dapat sesi satu hari.

2. **Keranjang Belanja**
   - Menambahkan produk ke dalam keranjang belanja.
   - Mengubah jumlah produk di keranjang.
   - Menghapus produk dari keranjang.

3. **Checkout**
   - Melihat ringkasan belanja sebelum checkout.
   - Memilih ongkos kirim.

4. **Pembelian dan Nota**
   - Mengonfirmasi dan menyelesaikan pembelian.
   - Mengunduh nota pembelian setelah pembayaran berhasil.

## Cara Menjalankan Proyek

1. Clone repositori ini ke dalam direktori lokal:

    ```bash
    git clone https://github.com/yourusername/seatscape-ecommerce.git
    ```

2. Import database ke dalam sistem manajemen database (misalnya, MySQL) dengan menggunakan file SQL yang telah disediakan (`seatscape.sql`).

3. Konfigurasikan file `config.php` dengan detail koneksi database yang sesuai.

4. Jalankan proyek pada server lokal atau hosting yang mendukung PHP.

## Teknologi dan Bahasa Pemrograman

1. PHP
2. MySQL (atau database lainnya yang sesuai)
3. HTML
4. CSS
5. JavaScript

## Struktur Direktori

```
seatscape-ecommerce/
|-- css/
|-- Templates/
|   |-- navbar.php
|-- config.php
|-- checkout.php
|-- index.php
|-- login.php
|-- nota.php
|-- README.md
|-- ...
```

## Catatan

- Pastikan bahwa ekstensi PHP `pdo_mysql` telah diaktifkan pada server PHP.
- Pastikan hak akses file dan direktori telah dikonfigurasi dengan benar.

## Kontribusi

Kontribusi dipersilakan. Jika menemui masalah atau memiliki ide untuk perbaikan, silakan buka *issue* atau *pull request*.

Selamat menggunakan dan mengembangkan Seatscape E-Commerce!
