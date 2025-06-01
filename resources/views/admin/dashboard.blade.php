@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4">Data Penjualan Toko Buku</h2>
        <canvas id="myChart" height="100"></canvas>
    </div>

    <input type="hidden" value="{{ json_encode($orders) }}" id="books_json">

    <script>

        const orders_json = document.getElementById('books_json').value;
        const orders = JSON.parse(orders_json);

        console.log(orders);

        let merged = [{}];

        orders.forEach(item => {
            if (merged[item.buku_id]) {
                merged[item.buku_id].qty += item.total_qty;
                merged[item.buku_id].total_pembelian += item.total_pembelian;
                merged[item.buku_id].judul = item.judul;
            } else {
                merged[item.buku_id] = {
                    buku_id: item.buku_id,
                    judul: item.judul,
                    qty: item.total_qty,
                    total_pembelian: item.total_pembelian
                };
            }
        });

        console.log(merged.map(book => book.judul));

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // jenis chart
            data: {
                labels: merged.map(book => book.judul),
                datasets: [{
                    label: 'total pembelian',
                    data: merged.map(book => book.qty),
                    backgroundColor: 'rgba(13, 110, 253, 0.7)', // bootstrap primary color
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#212529' // Bootstrap text color (dark)
                        }
                    }
                }
            }
        });
    </script>

@endsection