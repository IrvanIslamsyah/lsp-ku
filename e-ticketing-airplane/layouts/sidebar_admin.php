<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/e-ticketing-airplane/assets/style/sidebar_admin.css">
    <link rel="stylesheet" href="/e-ticketing-airplane/assets/sweet-alert/css/bootstrap.min.css">
    <link rel="stylesheet" href="/e-ticketing-airplane/assets/sweet-alert/css/sweetalert.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title></title>
</head>
<body>
    <div class="sidebar-admin" id="side_nav">
        <h2 class="text-lg font-semibold mb-4">Admin Panel</h2>

        <a href="/e-ticketing-airplane/admin/index.php" class="<?php if($page == "Dashboard") echo "active" ?> my-2">Dashboard</a>
        <a href="/e-ticketing-airplane/admin/pengguna/" class="<?php if($page == "Data Pengguna") echo "active" ?> my-2">Data Pengguna</a>
        <a href="/e-ticketing-airplane/admin/maskapai/" class="<?php if($page == "Data Maskapai") echo "active" ?> my-2">Data maskapai</a>
        <a href="/e-ticketing-airplane/admin/kota/" class="<?php if($page == "Data Kota") echo "active" ?> my-2">Data Kota</a>
        <a href="/e-ticketing-airplane/admin/rute/" class="<?php if($page == "Data Rute") echo "active" ?> my-2">Data Rute</a>
        <a href="/e-ticketing-airplane/admin/jadwal/" class="<?php if($page == "Data Jadwal") echo "active" ?> my-2">Data Jadwal</a>
        <a href="/e-ticketing-airplane/admin/order/" class="<?php if($page == "Data Order") echo "active" ?> my-2">Data Order</a>
        <a href="/e-ticketing-airplane/logout.php" onClick="return confirm('Apakah anda yakin ingin logout?')" class="logout">Logout</a>
    </div>


    <script src="/e-ticketing-airplane/assets/sweet-alert/js/jquery-2.1.4.min.js"></script>
    <script src="/e-ticketing-airplane/assets/sweet-alert/js/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>