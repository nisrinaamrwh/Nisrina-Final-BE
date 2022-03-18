<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', ['genres' => $genres]);
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'title' => 'required|min:3',
        ]);

        // Masukkan Ke Database
        Genre::create([
            'title' => $request->title,
        ]);

        // Redirect kalau berhasil
        return redirect('/genre')->with('success_msg', 'Genre berhasil dibuat');
    }
}
