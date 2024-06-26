<?php

$page = "Data Order";

require 'functions.php';
session_start();

if(!isset($_SESSION["username"])){
    echo "
    <script type='text/javascript'>
        alert('Silahkan login terlebih dahulu, ya!');
        window.location = '../auth/login/index.php';
    </script>
    ";
}

$orderTiket = query("SELECT * FROM order_tiket")

?>

<?php require '../../layouts/sidebar_admin.php'; ?>

<style>
    body{
        background: #eee;
    }   
    .container-order{
        background: #fff;
        width: 75%;
        padding: 10px;
        border-radius: 5px;
        margin: 25px auto;
        margin-left: 280px;
    }
    .container-order a{
        text-decoration: none;
        color: white;
    }
</style>

<div class="container-order">
    <h1>Halo, <?= $_SESSION["nama_lengkap"]; ?></h1>
    <h1>Data Pemesanan Tiket</h1>

    <table class="table table-striped">
        <thead class="text-center">
            <tr>
                <th>Nomor Order</th>
                <th>Struk</th>
                <th>Status</th>
                <th>Detail Pemesanan</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody  class="text-center">
            <?php foreach($orderTiket as $data) : ?>
            <tr>
                <td><?= $data["id_order"]; ?></td>
                <td><?= $data["struk"]; ?></td>
                <td>
                <?php 
                    if($data["status"] == "proses"){
                        ?>
                        <a href="update_status.php?id=<?= $data["id_order"]; ?>" style="color: blue; text-decoration: none;">Proses</a>
                        <?php
                    } else if($data["status"] == "berhasil"){
                        ?>
                        <a href="" style="color: green; text-decoration: none;">Berhasil</a>
                        <?php
                    } else if($data["status"] == "gagal"){
                        ?>
                        <a href="" style="color: red; text-decoration: none;">Gagal</a>
                        <?php
                    }
                ?>
                </td>
                <td><a href="detailOrder.php?id=<?= $data["id_order"]; ?>" class="btn btn-info">Detail</a></td>
                <td>
                    <?php if ($data["status"] == "proses"){
                        ?>
                        <!-- Modaal Verif -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalVerif<?= $data["id_order"] ?>">
                        Verifikasi
                        </button>
                        <!-- Modaal Reject -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalReject<?= $data["id_order"] ?>">
                        Reject
                        </button>
                    <?php }else if($data["status"] == "berhasil" || $data["status"] == "gagal"){
                        ?>
                        <!-- Modaal Hapus -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data["id_order"] ?>">
                        Hapus
                        </button>
                    <?php    
                    } ?>
                </td>
            </tr>
            <!-- Start Modal Hapus -->
            <div class="modal fade" id="modalHapus<?= $data["id_order"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Apakah Anda ingin menghapus data ini?</h5>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="hapus.php?id=<?= $data["id_order"]; ?>" class="btn btn-danger ">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Hapus -->
            <!-- Start Modal Verif -->
            <div class="modal fade" id="modalVerif<?= $data["id_order"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Verifikasi Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Apakah Anda ingin memverifikasi data ini?</h5>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="verif.php?id=<?= $data["id_order"]; ?>" class="btn btn-primary ">Verifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Verif -->
            <!-- Start Modal Verif -->
            <div class="modal fade" id="modalReject<?= $data["id_order"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Verifikasi Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Apakah Anda ingin memverifikasi data ini?</h5>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="reject.php?id=<?= $data["id_order"]; ?>" class="btn btn-danger ">Reject</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Verif -->
            <?php endforeach; ?>
        </tbody>
    </table>
</div>