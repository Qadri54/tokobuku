<?php
$koneksi = mysqli_connect("localhost", "root", "", "toko_buku_db");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
