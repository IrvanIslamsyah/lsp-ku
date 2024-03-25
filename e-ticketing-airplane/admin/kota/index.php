<?php

$page = "Data Kota";
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

$kota = query("SELECT * FROM kota");

?>

<?php require '../../layouts/sidebar_admin.php'; ?>

<style>
    body{
        background: #eee;
    }   
    .container-kota{
        background: #fff;
        width: 75%;
        padding: 10px;
        border-radius: 5px;
        margin: 25px auto;
        margin-left: 280px;
    }
</style>

<div class="container-kota">
    <h1>Halo, <?= $_SESSION["nama_lengkap"]; ?></h1>
    <h1>Halaman Data Kota</h1>

    <!-- Button Modal Tambah -->
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
    Tambah
    </button>

    <!-- Start Modal Tambah -->
    <form action="" method="POST">
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Rute</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="nama_kota">Nama Kota</label><br />
                            <input type="text" name="nama_kota" id="nama_kota" class="form-control">
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="tambah">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- END Modal tambah -->
    <?php
    
    if(isset($_POST["tambah"])){
        $nama_kota = htmlspecialchars($_POST["nama_kota"]);

        $query = "INSERT INTO kota VALUES (NULL, '$nama_kota')";
        mysqli_query($conn, $query);

        if($query){  
            echo "<script type='text/javascript'>
                    setTimeout(function () { 
                    swal({
                            title: 'Yay! Data berhasil ditambahkan!',
                            type: 'success',
                            timer: 3200,
                            showConfirmButton: true
                        });   
                    },10);  
                    window.setTimeout(function(){ 
                    window.location.replace('index.php');
                    } ,1000); 
                </script>";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Yhaa .. data pengguna gagal ditambahkan :(')
                    window.location = 'index.php'
                </script>
            ";
        }
        
    }

    ?>

    <table class="table table-striped">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama Kota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php $no = 1; ?>
            <?php foreach($kota as $data) : ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $data["nama_kota"]; ?></td>
                <td>
                    <!-- Button Modal Hapus -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data["id_kota"] ?>">
                        Hapus
                    </button>
                </td>
            </tr>
            <?php $no++; ?>
            <!-- Start Modal Hapus -->
            <div class="modal fade" id="modalHapus<?= $data["id_kota"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Apakah Anda ingin menghapus data ini?</h5>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="hapus.php?id=<?= $data["id_kota"]; ?>" class="btn btn-danger py-2 px-4">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Hapus -->
            <?php endforeach; ?>
        </tbody>
    </table>
</div>