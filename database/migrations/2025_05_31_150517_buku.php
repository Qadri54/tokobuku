<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class buku extends Migration {
    public function up() {
        Schema::create('buku', function (Blueprint $table) {
            $table->id('id_buku'); // Primary key
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->year('tahun_terbit');
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps(); // Menambahkan created_at dan updated_at
        });
    }

    public function down() {
        Schema::dropIfExists('buku');
    }
}

