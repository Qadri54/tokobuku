<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller {

    public function checkout(Request $request) {
        //melakukan proses pembelian
                
        $cart = json_decode($request->cart, true);

        foreach ($cart as $item) {
            $book = Book::where('judul', $item['judul'])->first();
            $book->stok -= $item['qty'];
            $book->save();
        }

        
        foreach ($cart as $item) {
            Order::create([
                'buku_id' => $item['id_buku'],
                'qty' => $item['qty'],
                'total_pembelian' => $item['qty']*$item['harga'],
            ]);
        }

        return redirect()->back()->with('success', 'Pembelian berhasil');
    }
}
