<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $folder = 'gambar/' . $gambar;

    if (move_uploaded_file($tmp, $folder)) {
        $query = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, harga, stok, gambar, deskripsi)
                VALUES ('$judul', '$penulis', '$penerbit', '$tahun', '$harga', '$stok', '$gambar', '$deskripsi')";

        if (mysqli_query($koneksi, $query)) {
            echo "Buku berhasil ditambahkan!";
        } else {
            echo "Gagal menyimpan ke database: " . mysqli_error($koneksi);
        }
    } else {
        echo "Upload gambar gagal!";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    Judul: <input type="text" name="judul"><br>
    Penulis: <input type="text" name="penulis"><br>
    Penerbit: <input type="text" name="penerbit"><br>
    Tahun Terbit: <input type="number" name="tahun"><br>
    Harga: <input type="number" name="harga"><br>
    Stok: <input type="number" name="stok"><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br>
    Gambar: <input type="file" name="gambar"><br>
    <button type="submit" name="submit">Upload</button>
</form>
