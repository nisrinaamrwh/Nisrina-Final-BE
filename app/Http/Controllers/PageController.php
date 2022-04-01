<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $movies = Movie::where('status', 'Accepted')->get();
        return view('index', [
            'movies' => $movies
        ]);
    }
}
