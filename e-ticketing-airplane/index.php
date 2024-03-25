<?php require 'layouts/navbar.php'; ?>
<?php

$jadwalPenerbangan = query("SELECT * FROM jadwal_penerbangan 
                            INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
                            INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai ORDER BY tanggal_pergi, waktu_berangkat");

?>
<div class="content">
    <div class="list-tiket-pesawat">
        <h1>Jadwal Penerbangan - E Ticketing</h1>
        <div class="wrapper-tiket-pesawat">
            <?php foreach($jadwalPenerbangan as $data) : ?>
                <div class="card-tiket-pesawat">
                    <a href="detail.php?id=<?= $data["id_jadwal"]; ?>" style="text-decoration: none; color: #000;">
                        <div class="image"><img src="assets/images/<?= $data["logo_maskapai"]; ?>"  width="80"></div>
                        <div class="nama-maskapai"><?= $data["nama_maskapai"]; ?></div>
                        <div class="tanggal-berangkat"><?= $data["tanggal_pergi"]; ?></div>
                        <div class="waktu-berangkat"><?= $data["waktu_berangkat"]; ?> - <?= $data["waktu_tiba"]; ?></div>
                        <div class="rute-penerbangan"><?= $data["rute_asal"] ?> - <?= $data["rute_tujuan"]; ?></div>
                        <div class="text-harga">Rp <?= number_format($data["harga"]); ?></div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>