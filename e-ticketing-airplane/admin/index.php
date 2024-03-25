<?php

$page = "Dashboard";
session_start();

if(!isset($_SESSION["username"])){
    echo "
    <script type='text/javascript'>
        alert('Silahkan login terlebih dahulu, ya!');
        window.location = '../auth/login/index.php';
    </script>
    ";
}


?>

<?php require '../layouts/sidebar_admin.php'; ?>

    <h1>Halo, <?= $_SESSION["nama_lengkap"]; ?></h1>
    