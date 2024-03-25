<?php

require '../../koneksi.php';

function query($query){

    global $conn;

    $rows = [];

    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;    
}

function hapus($id){
    global $conn; 
    mysqli_query($conn, "DELETE FROM order_tiket WHERE id_order = '$id'");
    return mysqli_affected_rows($conn);
}