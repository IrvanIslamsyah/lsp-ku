<?php require 'layouts/navbar.php'; ?>
<?php 

$id = $_GET["id"];

$jadwalPenerbangan = query("SELECT * FROM jadwal_penerbangan 
INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai WHERE id_jadwal = '$id'")[0];
?>


<h1>Detail Penerbangan</h1>
<div class="list-tiket-pswt">
    
    <div class="wrapper-detail-tiket-pesawat">
        <div class="label"><img src="assets/images/<?= $jadwalPenerbangan["logo_maskapai"]; ?>" width="200"></div>
        <div class="label">Nama Maskapai : <?= $jadwalPenerbangan["nama_maskapai"]; ?></div>
        <div class="label">Rute Asal : <?= $jadwalPenerbangan["rute_asal"]; ?></div>
        <div class="label">Rute Tujuan : <?= $jadwalPenerbangan["rute_tujuan"]; ?></div>
        <div class="label">Tanggal Berangkat : <?= $jadwalPenerbangan["tanggal_pergi"]; ?></div>
        <div class="label">Waktu Berangkat : <?= $jadwalPenerbangan["waktu_berangkat"]; ?></div>
        <div class="label">Waktu Tiba : <?= $jadwalPenerbangan["waktu_tiba"]; ?></div>
        <div class="label">Harga Tiket : <?= number_format($jadwalPenerbangan["harga"]); ?></div>
        <div class="label">Kapasitas : <?= $jadwalPenerbangan["kapasitas_kursi"]; ?></div>

        <form action="" method="POST">
            <input type="number" name="qty" value="1"><br>
            <button type="submit" name="pesan">Pesan</button>
        </form>
    </div>
</div>

<?php

if(isset($_POST["pesan"])){
    if($_POST["qty"] > $jadwalPenerbangan["kapasitas_kursi"]){
        echo "
            <script type='text/javascript'>
                alert('Mohon maaf kuantitas yang kamu beli melebih kuantitas yang tersedia')
            </script>
        ";
    }else if($_POST["qty"] <= 0){
        echo "
        <script type='text/javascript'>
            alert('Beli setidaknya 1 tiket, ya!')
            window.location = 'index.php'
        </script>
        ";
    }else{
        $qty = $_POST["qty"];
        $_SESSION["cart"][$id] = $qty;
        echo "
        <script type='text/javascript'>
            window.location = 'cart.php'
        </script>
        ";
    }
}

?>