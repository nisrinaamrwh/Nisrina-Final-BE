<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['category' => $categories]);
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'title' => 'required|min:3',
        ]);

        // Masukkan Ke Database
        Category::create([
            'title' => $request->title,
        ]);

        // Redirect kalau berhasil
        return redirect('/category')->with('success_msg', 'Kategori berhasil dibuat');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', ['category' => $categories]);
    }

    public function update(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'title' => 'required|min:3',
        ]);

        // Proses Update
        $category = Category::findOrFail($id);
        $category->update([
            'title' => $request->title,
        ]);

        // Redirect kalau berhasil
        return redirect('/category')->with('success_msg', 'Kategori berhasil diubah');
    }

    public function delete($id)
    {
        // Proses Delete
        $category = Category::findOrFail($id);
        $catefory->delete();

        // Redirect kalau berhasil
        return redirect('/category')->with('success_msg', 'Kategori berhasil dihapus');
    }
}
