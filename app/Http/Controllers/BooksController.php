<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Books::latest()->paginate(10);
        return view('admin.buku.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'sampul' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('sampul')) {
            $data['sampul'] = $request->file('sampul')->store('books', 'public');
        }

        Books::create($data);
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $books)
    {
        $data = Books::find($books->id);
        return view('admin.books.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $books)
    {
        $kategori = Kategori::all();
        return view('admin.buku.edit', compact('books', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Books $books)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('sampul')) {
            if ($books->sampul && Storage::disk('public')->exists($books->sampul)) {
                Storage::disk('public')->delete($books->sampul);
            }
            $data['sampul'] = $request->file('sampul')->store('books', 'public');
        } else {
            unset($data['sampul']);
        }

        $books->update($data);
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $books)
    {
        $books->delete();
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
