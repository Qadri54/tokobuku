<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = [
        'buku_id',
        'qty',
        'total_pembelian'
    ];

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
