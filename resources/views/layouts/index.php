<?php
include 'koneksi.php';
include 'header.php';
?>

<div class="container">
    <?php
    $delay = 0;
    $query = mysqli_query($koneksi, "SELECT * FROM buku");
    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $delay += 0.1;
            $rating = number_format(rand(35, 50) / 10, 1);
            $jumlah_ulasan = rand(5, 30);
    ?>
        <a href="javascript:void(0);" 
            class="card" 
            onclick="showDetailModal(this)" 
            data-judul="<?= htmlspecialchars($data['judul']) ?>"
            data-penulis="<?= htmlspecialchars($data['penulis']) ?>"
            data-harga="Rp <?= number_format($data['harga'], 0, ',', '.') ?>"
            data-gambar="gambar/<?= htmlspecialchars($data['gambar']) ?>"
            data-deskripsi="<?= htmlspecialchars($data['deskripsi'] ?? 'Deskripsi belum tersedia.') ?>"
            style="text-decoration: none; color: inherit; animation-delay: <?= $delay ?>s;">
            
            <img src="gambar/<?= htmlspecialchars($data['gambar']) ?>" alt="<?= htmlspecialchars($data['judul']) ?>">
            <h3><?= htmlspecialchars($data['judul']) ?></h3>
            <p>Penulis: <?= htmlspecialchars($data['penulis']) ?></p>
            <p>Rating: ⭐ <?= $rating ?> (<?= $jumlah_ulasan ?> ulasan)</p>
            <p><strong><?= "Rp " . number_format($data['harga'], 0, ',', '.') ?></strong></p>
        </a>
    <?php
        }
    } else {
        echo "<p style='grid-column: 1 / -1; text-align:center;'>Belum ada data buku.</p>";
    }
    ?>
</div>

<!-- Modal -->
<div id="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:2000; justify-content:center; align-items:center;">
    <div style="background:#fff; padding:30px; border-radius:12px; max-width:600px; width:90%; position:relative;">
        <span onclick="closeModal()" style="position:absolute; top:10px; right:15px; font-size:24px; cursor:pointer;">&times;</span>
        <img id="modal-img" src="" alt="" style="width:100%; border-radius:8px; margin-bottom:20px;">
        <h2 id="modal-title"></h2>
        <p id="modal-author" style="margin:5px 0;"></p>
        <p id="modal-price" style="margin:5px 0; font-weight:bold;"></p>
        <p id="modal-description" style="margin-top:15px;"></p>
    </div>
</div>

<script>
    function showDetailModal(el) {
        document.getElementById('modal-img').src = el.dataset.gambar;
        document.getElementById('modal-title').textContent = el.dataset.judul;
        document.getElementById('modal-author').textContent = "Penulis: " + el.dataset.penulis;
        document.getElementById('modal-price').textContent = el.dataset.harga;
        document.getElementById('modal-description').textContent = el.dataset.deskripsi;
        document.getElementById('modal').style.display = "flex";
    }

    function closeModal() {
        document.getElementById('modal').style.display = "none";
    }

    // Optional: close modal by clicking outside
    window.onclick = function(e) {
        const modal = document.getElementById('modal');
        if (e.target === modal) {
            closeModal();
        }
    }
</script>

</body>
</html>
