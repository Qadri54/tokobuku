@extends('layouts.app')

@section('content')
    <style>
        /* Style buku */
        #booksContainer {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
        }

        .book-card {
            cursor: pointer;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 180px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: #fff;
            transition: transform 0.2s ease;
            display: flex;
            flex-direction: column;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .book-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .book-info {
            padding: 10px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .book-title {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 4px;
            color: #333;
        }

        .book-author {
            font-size: 13px;
            color: #666;
            margin-bottom: 6px;
        }

        .book-rating {
            font-size: 13px;
            color: #ff9800;
            margin-bottom: 6px;
        }

        .book-price {
            font-weight: 700;
            font-size: 14px;
            color: #007bff;
        }

        /* Input cari dan filter */
        #searchInput,
        #priceFilter,
        #sortBy {
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
            margin-right: 10px;
            margin-bottom: 15px;
        }

        #filterSortContainer {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        /* Notifikasi sukses */
        #notifSuccess {
            position: fixed;
            bottom: 80px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            font-weight: 600;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            z-index: 3000;
        }

        #notifSuccess.show {
            opacity: 1;
            pointer-events: auto;
        }

        /* Icon keranjang fixed kanan bawah */
        #cartIcon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4);
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
            z-index: 2500;
            user-select: none;
        }

        #cartBadge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #dc3545;
            color: white;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 12px;
            font-weight: 700;
            display: none;
        }

        /* Modal keranjang */
        #cartModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 3000;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
        }

        #cartModalContent {
            background: #fff;
            border-radius: 12px;
            max-width: 500px;
            width: 90%;
            padding: 20px;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
        }

        #cartModalContent h3 {
            margin-bottom: 15px;
        }

        #cartModalContent ul {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
            max-height: 300px;
            overflow-y: auto;
        }

        #cartModalContent ul li {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            font-size: 15px;
        }

        #cartModalContent .close-btn {
            position: absolute;
            top: 12px;
            right: 15px;
            font-size: 28px;
            cursor: pointer;
            user-select: none;
        }

        /* Modal detail buku */
        #modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 4000;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
        }

        #modal>div {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            max-width: 600px;
            width: 90%;
            position: relative;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }

        #modal img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
            max-height: 350px;
            object-fit: contain;
        }

        #modal h2 {
            margin-top: 0;
            color: #222;
        }

        #modal p {
            margin: 5px 0;
            color: #444;
        }

        #modal button {
            margin-top: 20px;
            background: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        #modal button:hover {
            background: #0056b3;
        }

        #modal span.close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 28px;
            cursor: pointer;
            user-select: none;
            color: #999;
            transition: color 0.3s ease;
        }

        #modal span.close:hover {
            color: #333;
        }
    </style>

    <input type="text" id="searchInput" placeholder="Cari buku...">

    <div id="filterSortContainer">
        <select id="priceFilter">
            <option value="all">Semua Harga</option>
            <option value="low-10000">Di bawah Rp 10.000</option>
            <option value="10000-50000">Rp 10.000 - Rp 50.000</option>
            <option value="50000-100000">Rp 50.000 - Rp 100.000</option>
            <option value="above-100000">Di atas Rp 100.000</option>
        </select>

        <select id="sortBy">
            <option value="default">Sortir: Default</option>
            <option value="price-asc">Harga: Terendah ke Tertinggi</option>
            <option value="price-desc">Harga: Tertinggi ke Terendah</option>
            <option value="rating-desc">Rating: Tertinggi</option>
            <option value="rating-asc">Rating: Terendah</option>
        </select>
    </div>

    <!-- notifikasi jike pembelian berhasil -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="booksContainer">
        @forelse($books as $book)
            @php
                $rating = number_format(rand(35, 50) / 10, 1);
                $jumlah_ulasan = rand(5, 30);
                $gambar = $book->gambar && file_exists(public_path('gambar/' . $book->gambar))
                    ? asset('gambar/' . $book->gambar)
                    : asset('gambar/no-image.png');
            @endphp
            <div class="book-card" onclick="showDetailModal(this)" 
                data-judul="{{ $book->judul }}"
                data-id_buku = "{{ $book->id_buku }}"
                data-penulis="{{ $book->penulis }}" data-harga="{{ $book->harga }}"
                data-harga-format="Rp {{ number_format($book->harga, 0, ',', '.') }}" data-gambar="{{ $gambar }}"
                data-deskripsi="{{ $book->deskripsi ?? 'Deskripsi belum tersedia.' }}" data-rating="{{ $rating }}"
                data-search="{{ strtolower($book->judul) }} {{ strtolower($book->penulis) }}">

                <img src="{{ asset('storage/gambar/' . $book->gambar ?? 'no-image.png') }}" alt="{{ $book->judul }}" class="book-img">
                <div class="book-info">
                    <div class="book-author">Penulis: {{ $book->penulis }}</div>
                    <div class="book-title">{{ $book->judul }}</div>
                    <div class="book-rating">⭐ {{ $rating }} ({{ $jumlah_ulasan }})</div>
                    <div class="book-price">Rp {{ number_format($book->harga, 0, ',', '.') }}</div>
                </div>
            </div>
        @empty
            <p style="text-align:center; width:100%;">Belum ada data buku.</p>
        @endforelse
    </div>

    <!-- Modal Detail Buku -->
    <div id="modal">
        <div>
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modal-img" src="" alt="">
            <h2 id="modal-title"></h2>
            <p id="modal-author"></p>
            <p id="modal-price" style="font-weight:bold;"></p>
            <p id="modal-description" style="white-space: pre-line;"></p>
            <button id="addToCartBtn">Tambahkan ke Keranjang</button>
        </div>
    </div>

    <!-- Notifikasi sukses -->
    <div id="notifSuccess">Berhasil ditambahkan ke keranjang!</div>

    <!-- Icon keranjang fixed -->
    <div id="cartIcon" title="Lihat Keranjang">
        🛒
        <div id="cartBadge"></div>
    </div>

    <!-- Modal Keranjang -->
    <div id="cartModal">
        <div id="cartModalContent">
            <span class="close-btn" onclick="closeCartModal()">&times;</span>
            <h3>Keranjang Belanja</h3>
            <ul id="cartItemsList">
            </ul>
            <div><strong>Total: </strong><span id="cartTotal">Rp 0</span></div><br>
            <form action="{{ route('checkout') }}" id="orderfrom" method="post">
                @csrf
                <input type="hidden" name="cart" id="cart">
                <button id="checkoutBtn" type="submit">Checkout</button>
            </form>
        </div>
    </div>

    <script>
        // Data keranjang
        let cart = {};

        const addToCartBtn = document.getElementById('addToCartBtn');
        const notifSuccess = document.getElementById('notifSuccess');
        const cartIcon = document.getElementById('cartIcon');
        const cartBadge = document.getElementById('cartBadge');
        const cartModal = document.getElementById('cartModal');
        const cartItemsList = document.getElementById('cartItemsList');
        const cartTotal = document.getElementById('cartTotal');

        const orderfrom = document.getElementById('orderfrom');
        // Checkout
        orderfrom.addEventListener('submit', (e) => {
            const confirmation = confirm('Yakin ingin checkout?');

            if (!confirmation) {
                e.preventDefault();
            }
            document.getElementById('cart').value = JSON.stringify(cart);
        });

        // Tampilkan modal detail buku
        function showDetailModal(el) {
            document.getElementById('modal-img').src = el.dataset.gambar;
            document.getElementById('modal-title').textContent = el.dataset.judul;
            document.getElementById('modal-author').textContent = 'Penulis: ' + el.dataset.penulis;
            document.getElementById('modal-price').textContent = el.dataset.hargaFormat;
            document.getElementById('modal-description').textContent = el.dataset.deskripsi;

            addToCartBtn.dataset.judul = el.dataset.judul;
            addToCartBtn.dataset.harga = el.dataset.harga;
            addToCartBtn.dataset.id_buku = el.dataset.id_buku;

            document.getElementById('modal').style.display = 'flex';
        }

        // Tutup modal detail buku
        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        // Tambah buku ke keranjang
        addToCartBtn.addEventListener('click', () => {
            const judul = addToCartBtn.dataset.judul;
            const harga = parseInt(addToCartBtn.dataset.harga);
            const id_buku = parseInt(addToCartBtn.dataset.id_buku);

            if (cart[judul]) {
                cart[judul].qty++;
            } else {
                cart[judul] = { harga: harga, qty: 1, judul: judul, id_buku: id_buku };
            }
            updateCartBadge();
            showNotifSuccess();
            closeModal();
        });

        // Update tampilan jumlah item di badge keranjang
        function updateCartBadge() {
            const totalQty = Object.values(cart).reduce((sum, item) => sum + item.qty, 0);
            if (totalQty > 0) {
                cartBadge.style.display = 'block';
                cartBadge.textContent = totalQty;
            } else {
                cartBadge.style.display = 'none';
            }
        }

        // Tampilkan notifikasi sukses dengan animasi fade
        function showNotifSuccess() {
            notifSuccess.classList.add('show');
            setTimeout(() => {
                notifSuccess.classList.remove('show');
            }, 2000);
        }

        // Buka modal keranjang
        cartIcon.addEventListener('click', () => {
            renderCartItems();
            cartModal.style.display = 'flex';
        });

        // Tutup modal keranjang
        function closeCartModal() {
            cartModal.style.display = 'none';
        }

        // Render isi keranjang ke dalam modal
        function renderCartItems() {
            cartItemsList.innerHTML = '';
            let total = 0;
            if (Object.keys(cart).length === 0) {
                cartItemsList.innerHTML = '<li>Keranjang kosong</li>';
            } else {
                for (const [judul, item] of Object.entries(cart)) {
                    const itemTotal = item.harga * item.qty;
                    total += itemTotal;
                    const li = document.createElement('li');
                    li.innerHTML = `
                                    <span>${judul} (x${item.qty})</span>
                                    <span>Rp ${itemTotal.toLocaleString('id-ID')}</span>
                                    <button style="margin-left:10px;" onclick="removeFromCart('${judul}')">❌</button>
                                `;
                    cartItemsList.appendChild(li);
                }
            }
            cartTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Hapus item dari keranjang
        function removeFromCart(judul) {
            delete cart[judul];
            renderCartItems();
            updateCartBadge();
        }

        // Filter dan sorting buku
        const searchInput = document.getElementById('searchInput');
        const priceFilter = document.getElementById('priceFilter');
        const sortBy = document.getElementById('sortBy');
        const booksContainer = document.getElementById('booksContainer');

        function filterAndSortBooks() {
            const searchTerm = searchInput.value.toLowerCase();
            const priceValue = priceFilter.value;
            const sortValue = sortBy.value;

            let cards = Array.from(booksContainer.querySelectorAll('.book-card'));

            // Filter berdasarkan pencarian & harga
            cards.forEach(card => {
                const dataSearch = card.dataset.search;
                const harga = parseInt(card.dataset.harga);

                let matchesSearch = dataSearch.includes(searchTerm);
                let matchesPrice = true;

                switch (priceValue) {
                    case 'low-10000': matchesPrice = harga < 10000; break;
                    case '10000-50000': matchesPrice = harga >= 10000 && harga <= 50000; break;
                    case '50000-100000': matchesPrice = harga > 50000 && harga <= 100000; break;
                    case 'above-100000': matchesPrice = harga > 100000; break;
                }

                if (matchesSearch && matchesPrice) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });

            // Sort
            cards = cards.filter(c => c.style.display !== 'none');

            cards.sort((a, b) => {
                const hargaA = parseInt(a.dataset.harga);
                const hargaB = parseInt(b.dataset.harga);
                const ratingA = parseFloat(a.dataset.rating);
                const ratingB = parseFloat(b.dataset.rating);

                switch (sortValue) {
                    case 'price-asc': return hargaA - hargaB;
                    case 'price-desc': return hargaB - hargaA;
                    case 'rating-asc': return ratingA - ratingB;
                    case 'rating-desc': return ratingB - ratingA;
                    default: return 0;
                }
            });

            // Append ulang sesuai urutan baru
            cards.forEach(card => booksContainer.appendChild(card));
        }

        searchInput.addEventListener('input', filterAndSortBooks);
        priceFilter.addEventListener('change', filterAndSortBooks);
        sortBy.addEventListener('change', filterAndSortBooks);

        // Tutup modal jika klik di luar konten
        window.addEventListener('click', function (e) {
            if (e.target === document.getElementById('modal')) closeModal();
            if (e.target === cartModal) closeCartModal();
        });

        // Inisialisasi badge keranjang
        updateCartBadge();
    </script>

@endsection