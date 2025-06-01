<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller {
    // Tampilkan semua buku untuk publik tanpa pagination
    public function publicIndex(Request $request) {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('penulis', 'like', "%{$search}%")
                ->orWhere('penerbit', 'like', "%{$search}%");
        }

        $books = $query->orderBy('id_buku', 'desc')->get();

        return view('books.index', compact('books'));
    }

    // Tampilkan buku dengan pagination (khusus admin)
    public function index(Request $request) {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('penulis', 'like', "%{$search}%")
                ->orWhere('penerbit', 'like', "%{$search}%");
        }

        $books = $query->orderBy('id_buku', 'desc')->paginate(10)->withQueryString();

        return view('admin.index', compact('books'));
    }

    public function create() {
        return view('admin.books.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $file->getClientOriginalName();
            $file->storeAs('gambar', $filename, 'public');
            $validated['gambar'] = $filename;
        }

        Book::create($validated);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan');
    }


    public function show($id) {
        $book = Book::find($id);
        if (!$book)
            abort(404, 'Buku tidak ditemukan');

        return view('books.detail', compact('book'));
    }

    public function edit($id) {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, $id) {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($book->gambar && \Storage::disk('public')->exists('gambar/' . $book->gambar)) {
                \Storage::disk('public')->delete('gambar/' . $book->gambar);
            }

            // Simpan gambar baru dengan nama unik
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('gambar', $filename, 'public');
            $validated['gambar'] = $filename;
        }

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui');
    }



    public function destroy($id) {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus');
    }
}
