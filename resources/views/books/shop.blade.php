@extends('layout')

@section('title', 'TokoBuku - Shop')

@section('content')
<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
        <div class="card h-100">
            <img src="https://via.placeholder.com/150x200?text=Buku+1" class="card-img-top" alt="Buku 1">
            <div class="card-body">
                <h5 class="card-title">Judul Buku 1</h5>
                <p class="card-text">Deskripsi singkat buku 1.</p>
                <button class="btn btn-primary add-to-cart-btn" data-id="1" data-title="Judul Buku 1">Tambah ke Keranjang</button>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card h-100">
            <img src="https://via.placeholder.com/150x200?text=Buku+2" class="card-img-top" alt="Buku 2">
            <div class="card-body">
                <h5 class="card-title">Judul Buku 2</h5>
                <p class="card-text">Deskripsi singkat buku 2.</p>
                <button class="btn btn-primary add-to-cart-btn" data-id="2" data-title="Judul Buku 2">Tambah ke Keranjang</button>
            </div>
        </div>
    </div>
</div>

<button id="cartButton" 
    style="position: fixed; bottom: 20px; right: 20px; border-radius: 50%; width: 60px; height: 60px; 
           background-color: #3f51b5; color: white; border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.2);"
    title="Lihat Keranjang">
    🛒 <span id="cartCount" 
        style="position: absolute; top: 4px; right: 6px; background: red; color: white; font-size: 12px; 
               padding: 2px 6px; border-radius: 50%; font-weight: bold;">0</span>
</button>

<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">Keranjang Belanja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <ul id="cartItems" class="list-group"></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cart = [];
        const cartCountEl = document.getElementById('cartCount');
        const cartItemsEl = document.getElementById('cartItems');
        const cartButton = document.getElementById('cartButton');

        function updateCartCount() {
            cartCountEl.textContent = cart.length;
            cartCountEl.style.display = cart.length > 0 ? 'inline-block' : 'none';
        }

        function renderCart() {
            cartItemsEl.innerHTML = '';
            if(cart.length === 0) {
                cartItemsEl.innerHTML = '<li class="list-group-item text-center text-muted">Keranjang kosong.</li>';
                return;
            }
            cart.forEach(item => {
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.textContent = item.title;
                const btnRemove = document.createElement('button');
                btnRemove.className = 'btn btn-sm btn-danger';
                btnRemove.textContent = 'Hapus';
                btnRemove.onclick = () => {
                    const index = cart.findIndex(i => i.id === item.id);
                    if(index > -1) {
                        cart.splice(index, 1);
                        updateCartCount();
                        renderCart();
                    }
                };
                li.appendChild(btnRemove);
                cartItemsEl.appendChild(li);
            });
        }

        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                const title = btn.getAttribute('data-title');
                if(!cart.some(item => item.id === id)) {
                    cart.push({id, title});
                    updateCartCount();
                    alert(`"${title}" berhasil ditambahkan ke keranjang.`);
                } else {
                    alert(`"${title}" sudah ada di keranjang.`);
                }
            });
        });

        cartButton.addEventListener('click', () => {
            renderCart();
            const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            cartModal.show();
        });

        updateCartCount();
    });
</script>
@endpush
