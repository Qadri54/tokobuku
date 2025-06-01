<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Public route halaman utama daftar buku (shop)
Route::get('/', [BookController::class, 'publicIndex'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Group route admin prefix /admin & middleware auth admin
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD Buku admin
    Route::get('/books', [BookController::class, 'index'])->name('admin.books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('admin.books.create');
    Route::post('/books', [BookController::class, 'store'])->name('admin.books.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('admin.books.destroy');

    // Logout admin
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// chekout
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');


// Login admin tanpa middleware
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
