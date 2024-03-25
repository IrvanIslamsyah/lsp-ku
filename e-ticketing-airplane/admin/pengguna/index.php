<?php

$page = "Data Pengguna";
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

$pengguna = query("SELECT * FROM user WHERE roles = 'Petugas' || roles = 'Penumpang'");

?>

<?php require '../../layouts/sidebar_admin.php'; ?>

<style>
    body{
        background: #eee;
    }   
    .container-pengguna{
        background: #fff;
        width: 75%;
        padding: 10px;
        border-radius: 5px;
        margin: 25px auto;
        margin-left: 280px;
    }
</style>

<div class="container-pengguna">
    <h1>Halo, <?= $_SESSION["nama_lengkap"]; ?></h1>
    <h1>Halaman Pengguna</h1>

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
                            <label for="username">Username</label><br />
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="nama_lengkap">Nama Lengkap</label><br />
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="password">Password</label><br />
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="roles">Roles</label><br />
                            <select name="roles" id="roles" class="form-control" required placeholder="">
                                <option value="Petugas">Petugas</option>
                                <option value="Penumpang">Penumpang</option>
                            </select>
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
        $username = htmlspecialchars($_POST["username"]);
        $nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
        $password = htmlspecialchars($_POST["password"]);
        $roles = htmlspecialchars($_POST["roles"]);

        $query = "INSERT INTO user VALUES (NULL, '$username', '$nama_lengkap', '$password', '$roles')";
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
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Roles</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php $no = 1; ?>
            <?php foreach($pengguna as $data) : ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $data["username"]; ?></td>
                <td><?= $data["nama_lengkap"]; ?></td>
                <td><?= $data["roles"]; ?></td>
                <td>
                    <!-- Button Modal Edit -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $data["id_user"] ?>">
                        Edit
                    </button>
                    <!-- Button Modal Hapus -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data["id_user"] ?>">
                        Hapus
                    </button>
                </td>
            </tr>
            <?php $no++; ?>
            <!-- Start Modal Hapus -->
            <div class="modal fade" id="modalHapus<?= $data["id_user"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Apakah Anda ingin menghapus data ini?</h5>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="hapus.php?id=<?= $data["id_user"]; ?>" class="btn btn-danger py-2 px-4">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Hapus -->
            <!-- Start Modal Edit -->
            <div class="modal fade" id="modalEdit<?= $data["id_user"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Rute</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="POST">

                                <div class="mb-2">
                                    <input type="hidden" name="id_user" value="<?= $data["id_user"] ?>">

                                    <label for="username">Username</label><br />
                                    <input type="text" name="username" id="username" value="<?= $data["username"]; ?>" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="nama_lengkap">Nama Lengkap</label><br />
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= $data["nama_lengkap"]; ?>" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="password">Password</label><br />
                                    <input type="password" name="password" id="password" value="<?= $data["password"]; ?>" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="roles">Roles</label><br />
                                    <select name="roles" id="roles" class="form-control">
                                        <option value="<?= $data["roles"]; ?>"><?= $data["roles"]; ?></option>
                                        <option value="Petugas">Petugas</option>
                                        <option value="Penumpang">Penumpang</option>
                                    </select><br /> <br />
                                </div>

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="edit">Edit</button>
                            </form>
                            <?php
                            if(isset($_POST["edit"])){
                                $id = htmlspecialchars($_POST["id_user"]);
                                $username = htmlspecialchars($_POST["username"]);
                                $nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
                                $password = htmlspecialchars($_POST["password"]);
                                $roles = htmlspecialchars($_POST["roles"]);
                            
                                $query = "UPDATE user SET
                                username = '$username',
                                nama_lengkap = '$nama_lengkap',
                                password = '$password',
                                roles = '$roles' WHERE id_user = '$id'";
                            
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