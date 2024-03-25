<?php

require 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style/navbar.css">

</head>
<body>
    <div class="navbar">
        <div class="logo">E - Ticketing</div>
        <div class="menu">
            <a href="index.php">Beranda</a>
            <a href="index.php">Jadwal Penerbangan</a>
            <a href="cart.php">Pemesanan Tiket</a>
            <a href="history.php">Riwayat Pemesanan</a>
        </div>
        <div class="authentication">
            <?php if(isset($_SESSION["username"])) {
                ?>
                <span>Halo, <?= $_SESSION["nama_lengkap"]; ?></span>
                <a href="logout.php" class="logout">Logout</a>
                <?php
            }else{
                ?>
                <a href="auth/login/">Login</a>
                <a href="auth/register/">Register</a>
                <?php
            } ?>
        </div>
    </div>



</body>
</html>