<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller {
    public function index(Request $request) {
        $query = Order::query()->with('book');

        $orders = DB::table('orders')
            ->join('buku', 'buku_id', '=', 'id_buku')
            ->select(
                'orders.buku_id',
                'buku.judul',
                DB::raw('SUM(orders.qty) as total_qty'),
                DB::raw('SUM(orders.total_pembelian) as total_pembelian')
            )
            ->groupBy('orders.buku_id', 'buku.judul')
            ->orderBy('orders.buku_id', 'desc')
            ->get();

        return view('admin.dashboard', compact('orders'));
    }
}
