<?php require 'layouts/navbar.php'; ?>


<h1>List Pemesanan Tiket</h1>
<div class="list-tiket-pesawat">
    <?php if(empty($_SESSION["cart"])){
        ?>
            <h1>Belum ada tiket yang kamu pesan</h1>
        <?php
    }else {
        ?>
            <table cellpadding="10" cellspacing="0" border="1">
                <tr>
                    <th>No</th>
                    <th>Nama Maskapai</th>
                    <th>Rute</th>
                    <th>Tanggal Berangkat</th>
                    <th>Waktu Keberangkatan</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
                
                <?php $no = 1; ?>
                <?php $grandTotal = 0; ?>
                <?php foreach($_SESSION["cart"] as $id_jadwal => $kuantitas) : ?>
                <?php $jadwalPenerbangan = query("SELECT * FROM jadwal_penerbangan 
                INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
                INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai WHERE id_jadwal = '$id_jadwal'")[0]; 

                $totalHarga = $jadwalPenerbangan["harga"] * $kuantitas; 
                $grandTotal += $totalHarga; ?>

                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $jadwalPenerbangan["nama_maskapai"]; ?></td>
                    <td><?= $jadwalPenerbangan["rute_asal"]; ?> - <?= $jadwalPenerbangan["rute_tujuan"]; ?></td>
                    <td><?= $jadwalPenerbangan["tanggal_pergi"]; ?></td>
                    <td><?= $jadwalPenerbangan["waktu_berangkat"]; ?> - <?= $jadwalPenerbangan["waktu_tiba"]; ?></td>
                    <td>Rp <?= number_format($jadwalPenerbangan["harga"]); ?></td>
                    <td><?= $kuantitas; ?></td>
                    <td>Rp <?= number_format($totalHarga); ?></td>
                    <td>
                        <a href="hapusCart.php?=<?= $jadwalPenerbangan["id_jadwal"] ?>">Hapus</a>
                    </td>
                </tr>
                <?php $no++; ?>
                <?php endforeach; ?>

                <tr>
                    <td colspan="8">Grand Total</td>
                    <td>Rp <?= number_format($grandTotal) ?></td>
                </tr>
                <tr>
                    <td colspan="9">
                        <a href="checkout.php">Checkout</a>
                    </td>
                </tr>
            </table>
        <?php
    }
    ?>
</div>