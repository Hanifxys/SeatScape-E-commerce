<?php
session_start();

// Hapus semua variabel session
session_unset();

// Hapus session data
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <script>alert('Berhasil Logout');</script>
    <script>location='login.php'</script>
</body>
</html>
