<?php

$page = "Data Jadwal";
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

$jadwal = query("SELECT * FROM jadwal_penerbangan 
INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai ORDER BY tanggal_pergi, waktu_berangkat");

$rute = query("SELECT * FROM rute INNER JOIN maskapai ON maskapai.id_maskapai = rute.id_maskapai");

?>

<?php require '../../layouts/sidebar_admin.php'; ?>

<style>
    body{
        background: #eee;
    }   
    .container-jadwal{
        background: #fff;
        width: 80%;
        padding: 10px;
        border-radius: 5px;
        margin: 25px auto;
        margin-left: 280px;
    }
</style>

<div class="container-jadwal">
    <h1>Halo, <?= $_SESSION["nama_lengkap"]; ?></h1>
    <h1>Halaman Data Jadwal Penerbangan</h1>

    <!-- Trigger Modal Tambah -->
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
    Tambah
    </button>

    <table class="table table-striped">
        <thead class="text-center">
            <tr>
                <th class="py-2 px-4">No</th>
                <th class="py-2 px-4">Nama Maskapai</th>
                <th class="py-2 px-4">Kapasitas</th>
                <th class="py-2 px-4">Rute Asal</th>
                <th class="py-2 px-4">Rute Tujuan</th>
                <th class="py-2 px-4">Tanggal Pergi</th>
                <th class="py-2 px-4">Waktu Berangkat</th>
                <th class="py-2 px-4">Waktu Tiba</th>
                <th class="py-2 px-4">Harga</th>
                <th class="py-2 px-4">Aksi</th>
            </tr>
        </thead>

        <?php $no = 1; ?>
        <?php foreach($jadwal as $data) : ?>
        <tbody class="text-center">
            <tr>
                <td class="py-4 px-1"><?= $no; ?></td>
                <td class="py-4 px-1"><?= $data["nama_maskapai"]; ?></td>
                <td class="py-4 px-1"><?= $data["kapasitas_kursi"]; ?></td>
                <td class="py-4 px-1"><?= $data["rute_asal"]; ?></td>
                <td class="py-4 px-1"><?= $data["rute_tujuan"]; ?></td>
                <td class="py-4 px-1"><?= $data["tanggal_pergi"]; ?></td>
                <td class="py-4 px-1"><?= $data["waktu_berangkat"]; ?></td>
                <td class="py-4 px-1"><?= $data["waktu_tiba"]; ?></td>
                <td class="py-4 px-1">Rp <?= number_format($data["harga"]); ?></td>
                <td>
                    <!-- Trigger Modal Edit -->
                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $data["id_jadwal"] ?>">
                    Edit
                    </button>
                    <!-- Trigger Modal Hapus -->
                    <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data["id_jadwal"] ?>">
                    Hapus
                    </button>
                </td>
            </tr>
        </tbody>
        <?php $no++; ?>
        <!-- Start Modal Hapus -->
        <div class="modal fade" id="modalHapus<?= $data["id_jadwal"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Apakah Anda ingin menghapus data ini?</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="hapus.php?id=<?= $data["id_jadwal"]; ?>" class="btn btn-danger py-2 px-4">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Hapus -->
        <!-- Start Modal Edit -->
        <div class="modal fade" id="modalEdit<?= $data["id_jadwal"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Rute</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?php $id = $data["id_jadwal"] ?>
                    <?php $queryEdit = query("SELECT * FROM jadwal_penerbangan 
                                            INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
                                            INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai WHERE id_jadwal = '$id'")[0]; ?>
                    <div class="modal-body">
                        <form action="" method="POST">

                            <div class="mb-2">
                                <input type="hidden" name="id_jadwal" value="<?= $queryEdit["id_jadwal"] ?>">

                                <label for="id_rute">Pilih Rute</label><br />
                                <select name="id_rute" id="id_rute" class="form-control">
                                    <option value="<?= $queryEdit["id_rute"]; ?>"><?= $queryEdit["nama_maskapai"]; ?> - <?= $queryEdit["rute_asal"]; ?> - <?= $queryEdit["rute_tujuan"]; ?></option>
                                    <?php foreach($rute as $data) : ?>
                                    <option value="<?= $data["id_rute"]; ?>"><?= $data["nama_maskapai"]; ?> - <?= $data["rute_asal"]; ?> - <?= $data["rute_tujuan"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="waktu_berangkat">Waktu Berangkat</label><br />
                                <input type="time" name="waktu_berangkat" id="waktu_berangkat" value="<?= $queryEdit["waktu_berangkat"]; ?>" class="form-control">
                            </div>

                            <div class="mb-2">
                                <label for="waktu_tiba">Waktu Tiba</label><br />
                                <input type="time" name="waktu_tiba" id="waktu_tiba" value="<?= $queryEdit["waktu_tiba"]; ?>" class="form-control">
                            </div>

                            <div class="mb-2">
                                <label for="harga">Harga</label><br />
                                <input type="number" name="harga" id="harga" value="<?= $queryEdit["harga"]; ?>" class="form-control">
                            </div>

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" name="edit">Edit</button>
                        </form>
                        <?php
                        if(isset($_POST["edit"])){
                            $id = htmlspecialchars($_POST["id_jadwal"]);
                            $id_rute = htmlspecialchars($_POST["id_rute"]);
                            $waktu_berangkat = htmlspecialchars($_POST["waktu_berangkat"]);
                            $waktu_tiba = htmlspecialchars($_POST["waktu_tiba"]);
                            $harga = htmlspecialchars($_POST["harga"]);

                            $query = "UPDATE jadwal_penerbangan SET
                            id_rute = '$id_rute',
                            waktu_berangkat = '$waktu_berangkat',
                            waktu_tiba = '$waktu_tiba',
                            harga = '$harga' WHERE id_jadwal = '$id'";

                            mysqli_query($conn, $query);
                            if($query){  
                                echo "<script type='text/javascript'>
                                        setTimeout(function () { 
                                        swal({
                                                title: 'Yay! pembelian formulir berhasil!',
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
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Edit -->
        <?php endforeach; ?>
    </table>

    <!-- Modal Tambah -->
    <form action="" method="POST">
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jadwal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label for="id_rute">Pilih Rute</label><br />
                        <select name="id_rute" id="id_rute" class="form-control">
                            <?php foreach($rute as $data) : ?>
                            <option value="<?= $data["id_rute"]; ?>"><?= $data["nama_maskapai"]; ?> - <?= $data["rute_asal"]; ?> - <?= $data["rute_tujuan"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="waktu_berangkat">Waktu Berangkat</label><br />
                        <input type="time" name="waktu_berangkat" id="waktu_berangkat" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label for="waktu_tiba">Waktu Tiba</label><br />
                        <input type="time" name="waktu_tiba" id="waktu_tiba" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label for="harga">Harga</label><br />
                        <input type="number" name="harga" id="harga" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label for="kapasitas_kursi">Kapasitas</label><br />
                        <input type="number" name="kapasitas_kursi" id="kapasitas_kursi" class="form-control">
                    </div>
                
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                </div>
            </div>
        </div>
    </form>
    <?php
    if(isset($_POST["tambah"])){
        $id_rute = htmlspecialchars($_POST["id_rute"]);
        $waktu_berangkat = htmlspecialchars($_POST["waktu_berangkat"]);
        $waktu_tiba = htmlspecialchars($_POST["waktu_tiba"]);
        $harga = htmlspecialchars($_POST["harga"]);
        $kursi = htmlspecialchars($_POST["kapasitas_kursi"]);

        $query = "INSERT INTO jadwal_penerbangan VALUES (NULL, '$id_rute', '$waktu_berangkat', '$waktu_tiba', '$harga', '$kursi')";
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
                    alert('Yhaa .. data jadwal gagal ditambahkan :(')
                    window.location = 'index.php'
                </script>
            ";
        }
    }

    ?>

    
</div>