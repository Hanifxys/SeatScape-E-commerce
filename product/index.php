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
    <title>Your Website</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/product.css">
    <!-- <link rel="stylesheet" href="../css/footer.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
   header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 50px;
            background-color: #f0f0f0;
            height: 100vh; /* Tambahkan baris ini untuk membuat header satu halaman penuh */
        }


        .content-container {
            flex: 1;
        }

        .main-headings {
            font-size: 2em;
        }

        .primary-headings {
            font-size: 1.2em;
            margin-top: 10px;
        }

        .btns-container {
            margin-top: 20px;
        }

        .btn-fill,
        .btn-outline {
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
        }

        .img-container {
            flex: 1;
            text-align: right;
        }

        .img-container img {
            max-width: 100%;
            height: auto;
        }

        .product-image {
            width: 130%;
            height: 310px; /* Adjust the height as needed */
            object-fit: cover;
            border-bottom: 1px solid #e0e0e0;
            border-radius: 8px 8px 0 0;
        }
        p.product-description {
            color: #333; /* Darker color for better readability */
            font-size: 1.1rem;
            margin-bottom: 30px;
           
        }


               .elegant-button {
            background: linear-gradient(45deg, #009688, #004d40);
            border: none;
            color: #fff;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            border-radius: 8px;
            transition: background 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .elegant-button:hover {
            background: linear-gradient(45deg, #00796b, #004d40);
        }

        .container {
          width: 100%;
          margin: auto;
          text-align: center;
          padding-top: 10px;
          display: flex;
          align-items: center;
          justify-content: center;
          flex-wrap: wrap;
        }

        .title {
          font-size: 2rem;
          margin-bottom: 30px;
          color: #333;
          width: 100vw;
        }

   
        @media only screen and (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
                padding: 20px;
                height: 125vh;
            }

            .img-container {
                text-align: center;
                margin-top: 20px;
            }
        }

    </style>
</head>

<body>
<?php include '../Templates/navbar.php'; ?>

<div class="container">
    <div class="title">PRODUCT LIST</div>
    <div class="listProduct">

    <?php
    $ambil = $pdo->prepare('SELECT * FROM product');
    $ambil->execute();
    $products = $ambil->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
    ?>
        <div class="item">
            <img  class="product-image" src="http://localhost:8081/Seatscape/<?php echo $product['foto_product']; ?>" alt="">
            <h2><?php echo $product['nama_product']; ?></h2>
            <div class="price">Rp <?php echo number_format($product['harga_product']); ?></div>
            <p  class="product-description"><?php echo $product['deskripsi_product']; ?></p>
            <a class="elegant-button" href="beli.php?id=<?php echo $product['id_product']; ?>">Beli</a>
        </div>
    <?php
    }
    ?>

    

    </div>
</div>

<?php include '../Templates/footer.php' ?>

</body>

</html>
