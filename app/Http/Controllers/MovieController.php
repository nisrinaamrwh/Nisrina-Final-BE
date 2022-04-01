<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        // if(Auth::user()->role == 'Member'){
        //     $movies = Movie::where('user_id', Auth::user()->id)->get();
        // }else{
        //     $movies = Movie::all();
        // }
        $movies = Auth::user()->role == 'Member' ? Movie::where('user_id', Auth::user()->id)->get() : Movie::all();
        return view('movies.index', [
            'genres' => $genres,
            'movies' => $movies
        ]);
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'thumbnail' => 'required',
            'title' => 'required|min:5',
            'description' => 'required|min:10|max:300',
            'tahun_rilis' => 'required',
            'genre' => 'required'
        ]);

        // File Processing
        $files = $request->file('thumbnail');
        $fullFileName = $files->getClientOriginalName();
        $fileName = pathinfo($fullFileName)['filename'];
        $extension = $files->getClientOriginalExtension();
        $thumbnail = $fileName . '-' . date('YmdHis') . '.' . $extension;
        $files->storeAs('public/movies/', $thumbnail);

        // Insert Data
        Movie::Create([
            'thumbnail' => $thumbnail,
            'title' => $request->title,
            'description' => $request->description,
            'tahun_rilis' => $request->tahun_rilis,
            'genre_id' => $request->genre,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/movie')->with('success_msg', 'Movie berhasil ditambahkan');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        return view('movies.edit', [
            'movie' => $movie,
            'genres' => $genres
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->file('thumbnail' == null)) {
            // Validasi
            $request->validate([
                'title' => 'required|min:5',
                'description' => 'required|min:10|max:300',
                'tahun_rilis' => 'required',
                'genre' => 'required'
            ]);

            // Temukan Movie yang mau di update dan update
            $movie = Movie::findOrFail($id);
            $movie->update([
                'title' => $request->title,
                'description' => $request->description,
                'tahun_rilis' => $request->tahun_rilis,
                'genre_id' => $request->genre,
            ]);

            return redirect('/movie')->with('success_msg', 'Movie berhasil diedit');
        } else {
            // Validasi
            $request->validate([
                'thumbnail' => 'required',
                'title' => 'required|min:5',
                'description' => 'required|min:10|max:300',
                'tahun_rilis' => 'required',
                'genre' => 'required'
            ]);

            // File Processing
            $files = $request->file('thumbnail');
            $fullFileName = $files->getClientOriginalName();
            $fileName = pathinfo($fullFileName)['filename'];
            $extension = $files->getClientOriginalExtension();
            $thumbnail = $fileName . '-' . date('YmdHis') . '.' . $extension;
            $files->storeAs('public/movies/', $thumbnail);

            // Temukan Movie yang mau di update dan update
            $movie = Movie::findOrFail($id);
            if (Storage::exists('public/movies/' . $movie->thumbnail)) {
                Storage::delete('public/movies/' . $movie->thumbnail);
            }
            $movie->update([
                'thumbnail' => $thumbnail,
                'title' => $request->title,
                'description' => $request->description,
                'tahun_rilis' => $request->tahun_rilis,
                'genre_id' => $request->genre,
            ]);

            return redirect('/movie')->with('success_msg', 'Movie berhasil diedit');
        }
    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);
        if (Storage::exists('public/movies/' . $movie->thumbnail)) {
            Storage::delete('public/movies/' . $movie->thumbnail);
        }
        $movie->delete();

        return redirect('/movie')->with('success_msg', 'Movie berhasil dihapus');
    }
}
