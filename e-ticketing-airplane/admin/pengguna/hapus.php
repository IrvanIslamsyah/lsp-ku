<?php

session_start();
require 'functions.php';

if(!isset($_SESSION["username"])){
    echo "
    <script type='text/javascript'>
        alert('Silahkan login terlebih dahulu, ya!');
        window.location = '../../auth/login/index.php';
    </script>
    ";
}

$id = $_GET["id"];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/e-ticketing/assets/sweet-alert/css/bootstrap.min.css">
    <link rel="stylesheet" href="/e-ticketing/assets/sweet-alert/css/sweetalert.css">
    <title></title>
</head>
<body>
    
<?php if(hapus($id) > 0){
    echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({
                title: 'Berhasil',
                text: 'Yay! data berhasil dihapus',
                type: 'success',
                timer: 3200,
                showConfirmButton: true
            });   
    },10);  
    window.setTimeout(function(){ 
        window.location.replace('index.php');
    } ,1000); 
    </script>";
}
?>

<script src="/e-ticketing/assets/sweet-alert/js/jquery-2.1.4.min.js"></script>
<script src="/e-ticketing/assets/sweet-alert/js/sweetalert.min.js"></script>
</body>
</html>


