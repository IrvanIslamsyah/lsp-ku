<?php

$page = "Data Rute";
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

$rute = query("SELECT * FROM rute INNER JOIN maskapai ON maskapai.id_maskapai = rute.id_maskapai ORDER BY rute_asal");
$maskapai = query("SELECT * FROM maskapai");
$kota = query("SELECT * FROM kota");

?>

<?php require '../../layouts/sidebar_admin.php'; ?>

<style>
    body{
        background: #eee;
    }   
    .container-rute{
        background: #fff;
        width: 75%;
        padding: 10px;
        border-radius: 5px;
        margin: 25px auto;
        margin-left: 280px;
    }
</style>

<div class="container-rute">
    <h1 class="text-2xl font-semibold mb-2">Data Rute Penerbangan</h1>

    <!-- Trigger Modal Tambah -->
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
    Tambah
    </button>

    <!-- Modal Tambah -->
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
                        <label for="nama_maskapai" class="form-label">Nama Maskapai</label><br />
                        <select name="id_maskapai" id="id_maskapai" class="form-control">
                            <?php foreach($maskapai as $data) : ?>
                            <option value="<?= $data["id_maskapai"]; ?>"><?= $data["nama_maskapai"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="rute_asal" class="form-label">Rute Asal</label><br />
                        <select name="rute_asal" id="rute_asal" class="form-control">
                            <?php foreach($kota as $data) : ?>
                            <option value="<?= $data["nama_kota"]; ?>"><?= $data["nama_kota"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="rute_tujuan" class="form-label">Rute Tujuan</label><br />
                        <select name="rute_tujuan" id="rute_tujuan" class="form-control">
                            <?php foreach($kota as $data) : ?>
                            <option value="<?= $data["nama_kota"]; ?>"><?= $data["nama_kota"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="tanggal_pergi" class="form-label">Tanggal Pergi</label><br />
                        <input type="date" name="tanggal_pergi" id="tanggal_pergi" class="form-control">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="tambah">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    if(isset($_POST["tambah"])){
        $id_maskapai = htmlspecialchars($_POST["id_maskapai"]);
        $rute_asal = htmlspecialchars($_POST["rute_asal"]);
        $rute_tujuan = htmlspecialchars($_POST["rute_tujuan"]);
        $tanggal_pergi = htmlspecialchars($_POST["tanggal_pergi"]);

        $query = "INSERT INTO rute VALUES(NULL, '$id_maskapai', '$rute_asal', '$rute_tujuan', '$tanggal_pergi')";
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

<table class="table table-striped">
    <thead class="text-center">
        <tr>
            <th class="px-2 py-2">No</th>
            <th class="px-2 py-2">Nama Maskapai</th>
            <th class="px-2 py-2">Rute Asal</th>
            <th class="px-2 py-2">Rute Tujuan</th>
            <th class="px-2 py-2">Tanggal Pergi</th>
            <th class="px-2 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach($rute as $data) : ?>
        <tr>
            <td class="px-2 py-2"><?= $no; ?></td>
            <td class="px-2 py-2"><?= $data["nama_maskapai"]; ?></td>
            <td class="px-2 py-2"><?= $data["rute_asal"]; ?></td>
            <td class="px-2 py-2"><?= $data["rute_tujuan"]; ?></td>
            <td class="px-2 py-2"><?= $data["tanggal_pergi"]; ?></td>
            <td class="px-2 py-2">
                <!-- Button Modal Edit -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $data["id_rute"]; ?>">
                Edit
                </button>
                <!-- Button Modal Hapus -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data["id_rute"]; ?>">
                Hapus
                </button>
            </td>
        </tr>
        <?php $no++; ?>
        <!-- START MODAL HAPUS -->
        <div class="modal fade" id="modalHapus<?= $data["id_rute"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Apakah Anda ingin menghapus data ini?</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="hapus.php?id=<?= $data["id_rute"]; ?>" class="btn btn-danger py-2 px-4">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL HAPUS -->

        <!-- Start MODAL EDIT -->
            <div class="modal fade" id="modalEdit<?= $data["id_rute"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Rute</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <?php $id = $data["id_rute"]; ?>
                    <?php $queryEdit = query("SELECT * FROM rute INNER JOIN maskapai ON maskapai.id_maskapai = rute.id_maskapai WHERE id_rute = '$id'")[0]; ?>
                    <div class="modal-body">

                    <form action="" method="POST">

                        <div class="mb-2">
                            <input type="hidden" name="id_rute" value="<?= $queryEdit["id_rute"]; ?>">

                            <label for="nama_maskapai" class="form-label">Nama Maskapai</label><br />
                            <select name="id_maskapai" id="id_maskapai" class="form-control">  
                                <option value="<?= $queryEdit["id_maskapai"]; ?>"><?= $queryEdit["nama_maskapai"]; ?></option>
                                <?php foreach($maskapai as $data) : ?>
                                <option value="<?= $data["id_maskapai"]; ?>"><?= $data["nama_maskapai"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="rute_asal" class="form-label">Rute Asal</label><br />
                            <select name="rute_asal" id="rute_asal" class="form-control">
                                <option value="<?= $queryEdit["rute_asal"]; ?>"><?= $queryEdit["rute_asal"]; ?></option>
                                <?php foreach($kota as $data) : ?>
                                <option value="<?= $data["nama_kota"]; ?>"><?= $data["nama_kota"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <label for="rute_tujuan" class="form-label">Rute Tujuan</label><br />
                        <select name="rute_tujuan" id="rute_tujuan" class="form-control">
                            <option value="<?= $queryEdit["rute_tujuan"]; ?>"><?= $queryEdit["rute_tujuan"]; ?></option>
                            <?php foreach($kota as $data) : ?>
                            <option value="<?= $data["nama_kota"]; ?>"><?= $data["nama_kota"]; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="tanggal_pergi" class="form-label">Tanggal Pergi</label><br />
                        <input type="date" name="tanggal_pergi" id="tanggal_pergi" value="<?= $queryEdit["tanggal_pergi"]; ?>" class="form-control"><br />

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="edit">Save changes</button>
                        </form>
                        
                        <?php
                        if(isset($_POST["edit"])){
                            $id = htmlspecialchars($_POST["id_rute"]);
                            $id_maskapai = htmlspecialchars($_POST["id_maskapai"]);
                            $rute_asal = htmlspecialchars($_POST["rute_asal"]);
                            $rute_tujuan = htmlspecialchars($_POST["rute_tujuan"]);
                            $tanggal_pergi = htmlspecialchars($_POST["tanggal_pergi"]);

                            $query = "UPDATE rute SET
                            id_maskapai = '$id_maskapai',
                            rute_asal = '$rute_asal',
                            rute_tujuan = '$rute_tujuan',
                            tanggal_pergi = '$tanggal_pergi' WHERE id_rute = '$id'";

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
        <!-- END MODAL EDIT -->
            <?php endforeach; ?>
        </tbody>
    </table>

</div>