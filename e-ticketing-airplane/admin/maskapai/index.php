<?php

$page = "Data Maskapai";
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

$maskapai = query("SELECT * FROM maskapai");

?>

<?php require '../../layouts/sidebar_admin.php'; ?>

<style>
    body{
        background: #eee;
    }   
    .container-maskapai{
        background: #fff;
        width: 75%;
        padding: 10px;
        border-radius: 5px;
        margin: 25px auto;
        margin-left: 280px;
    }
</style>

<div class="container-maskapai">

    <h1>Halo, <?= $_SESSION["nama_lengkap"]; ?></h1>
    <h1>Halaman Maskapai</h1>

    <!-- Button Modal Tambah -->
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
    Tambah
    </button>

    <!-- Start Modal Tambah -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Rute</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-2">
                            <label for="logo_maskapai" class="form-label">Logo Maskapai</label><br />
                            <input type="file" name="logo_maskapai" id="logo_maskapai" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="nama_maskapai" class="form-label">Nama Maskapai</label><br />
                            <input type="text" name="nama_maskapai" id="nama_maskapai" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="kapasitas" class="form-label">Kapasitas</label><br />
                            <input type="number" name="kapasitas" id="kapasitas" class="form-control">
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
        $logo_maskapai = $_FILES["logo_maskapai"]["name"];
        $files = $_FILES["logo_maskapai"]["tmp_name"];
        $nama_maskapai = htmlspecialchars($_POST["nama_maskapai"]);
        $kapasitas = htmlspecialchars($_POST["kapasitas"]);

        $query = "INSERT INTO maskapai VALUES(NULL, '$logo_maskapai', '$nama_maskapai', '$kapasitas')";

        move_uploaded_file($files, "../../assets/images/".$logo_maskapai);

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
                    alert('Yhaa .. data maskapai gagal ditambahkan :(')
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
                <th>Logo</th>
                <th>Nama Maskapai</th>
                <th>Kapasitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php $no = 1; ?>
            <?php foreach($maskapai as $data) : ?>
            <tr>
                <td><?= $no; ?></td>
                <td><img src="../../assets/images/<?= $data["logo_maskapai"]; ?>" width="80"></td>
                <td><?= $data["nama_maskapai"]; ?></td>
                <td><?= $data["kapasitas"]; ?></td>
                <td>
                    <!-- Button Modal Edit -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $data["id_maskapai"] ?>">
                        Edit
                    </button>
                    <!-- Button Modal Hapus -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data["id_maskapai"] ?>">
                        Hapus
                    </button>
                </td>
            </tr>
            <?php $no++; ?>
            <!-- Start Modal Hapus -->
            <div class="modal fade" id="modalHapus<?= $data["id_maskapai"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Apakah Anda ingin menghapus data ini?</h5>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="hapus.php?id=<?= $data["id_maskapai"]; ?>" class="btn btn-danger py-2 px-4">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Hapus -->
            <!-- Start Modal Edit -->
            <div class="modal fade" id="modalEdit<?= $data["id_maskapai"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Rute</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="POST" enctype="multipart/form-data">

                                <div class="mb-2">
                                    <input type="hidden" name="id_maskapai" value="<?= $data["id_maskapai"] ?>">

                                    <label for="logo_maskapai">Logo</label><br />
                                    <input type="file" name="logo_maskapai" id="logo_maskapai" value="<?= $data["logo_maskapai"]; ?>" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="nama_maskapai">Nama Maskapai</label><br />
                                    <input type="text" name="nama_maskapai" id="nama_maskapai" value="<?= $data["nama_maskapai"]; ?>" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="kapasitas">Kapasitas</label><br />
                                    <input type="number" name="kapasitas" id="kapasitas" value="<?= $data["kapasitas"]; ?>" class="form-control">
                                </div>

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="edit">Edit</button>
                            </form>
                            <?php
                            if(isset($_POST["edit"])){
                                $id = htmlspecialchars($_POST["id_maskapai"]);
                                $logo_maskapai = $_FILES["logo_maskapai"]["name"];
                                $files = $_FILES["logo_maskapai"]["tmp_name"];
                                $nama_maskapai = htmlspecialchars($_POST["nama_maskapai"]);
                                $kapasitas = htmlspecialchars($_POST["kapasitas"]);

                                if(empty($logo_maskapai)){
                                    $query = "UPDATE maskapai SET
                                    nama_maskapai = '$nama_maskapai',
                                    kapasitas = '$kapasitas' WHERE id_maskapai = '$id'";

                                    mysqli_query($conn, $query);
                                    if($query){  
                                        echo "<script type='text/javascript'>
                                                setTimeout(function () { 
                                                swal({
                                                        title: 'Yay! Data berhasil diedit!',
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
                                }else{
                                    $query = "UPDATE maskapai SET
                                    logo_maskapai = '$logo_maskapai',
                                    nama_maskapai = '$nama_maskapai',
                                    kapasitas = '$kapasitas' WHERE id_maskapai = '$id'";

                                    move_uploaded_file($files, "../../assets/images/".$logo_maskapai);
                                    mysqli_query($conn, $query);
                                    if($query){  
                                        echo "<script type='text/javascript'>
                                                setTimeout(function () { 
                                                swal({
                                                        title: 'Yay! Data berhasil diedit!',
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
                            }
                            ?>

                        </div>
                        
                            
                    </div>
                </div>
            </div>
            <!-- End Modal Edit -->
            <?php endforeach; ?>
        </tbody>
    </table>
</div>