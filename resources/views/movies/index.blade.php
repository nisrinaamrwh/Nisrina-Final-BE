@extends('layouts.app')
@section('title', 'Manage Movie | MovieApp')

@section('content')
    {{-- CREATE MOVIE --}}
    @include('movies.create', $genres)

    <div class="container mt-5">
        <div class="col-md-9 bg-light rounded p-3">
            {{-- HEADER --}}
            <h3 class="text-dark">Manage Movies</h3>
            <p class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni facere, consectetur
                maiores maxime laborum</p>
            <hr>

            {{-- TABLE --}}
            @if (Auth::user()->role == 'Member')
                <a href="#" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#createMovieModal">
                    <i class="uil uil-plus-circle me-1"></i>
                    Create Movie
                </a>
            @endif
            @if (session('success_msg'))
                <div class="alert alert-success mt-3">{{ session('success_msg') }}</div>
            @endif

            @if ($movies->count() != 0)
                <table class="table table-success table-striped mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Movie Title</th>
                            <th>Description</th>
                            <th>Release Year</th>
                            <th>Author</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><img src="{{ asset('storage/movies/' . $movie->thumbnail) }}" width="100"></td>
                                <td>
                                    <span class="d-block">{{ $movie->title }}</span>
                                    <span class="badge bg-dark me-2">{{ $movie->genre->title }}</span>
                                    <span class="badge bg-primary">{{ $movie->tahun_rilis }}</span>
                                </td>
                                <td>{{ $movie->description }}</td>
                                <td>{{ $movie->tahun_rilis }}</td>
                                <td>{{ $movie->user->name }}</td>
                                <td>
                                    @if (Auth::user()->role == 'Member')
                                        <a href="{{ route('editMovie', $movie->id) }}" class="text-primary"><i
                                                class="uil uil-edit"></i></a>
                                    @endif
                                    <a href="" class="text-danger"
                                        onclick="event.preventDefault();document.getElementById('delete-form').submit()">
                                        <i class="uil uil-trash-alt"></i>
                                        <form action="{{ route('deleteMovie', $movie->id) }}" method="POST"
                                            id="delete-form" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning mt-3">
                    Movie masih kosong nih :(
                </div>
            @endif
        </div>
    </div>
@endsection
