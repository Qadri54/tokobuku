<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';   // Tambahkan ini
    public $timestamps = false;           // Kalau tidak pakai created_at dan updated_at

    protected $fillable = [
        'judul', 'penulis', 'penerbit', 'tahun_terbit',
        'harga', 'stok', 'deskripsi', 'gambar'
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
