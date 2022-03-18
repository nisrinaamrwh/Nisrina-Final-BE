@extends('layouts.app')
@section('title', 'Genre | MovieApp')

@section('content')
    {{-- CREATE GENRE --}}
    @include('genres.create')

    {{-- TABLE --}}
    <div class="container mt-5">
        <div class="col-md-7 bg-light rounded p-3">
            <h3 class="text-dark">Manage Genres</h3>
            <p class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni facere, consectetur
                maiores maxime laborum</p>
            <hr>
            <a href="#" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                    class="uil uil-plus-circle me-1"></i>Buat Genre</a>
            @if (session('success_msg'))
                <div class="alert alert-success mt-3">{{ session('success_msg') }}</div>
            @endif
            <table class="table table-success table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Genre</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $genre->title }}</td>
                            <td>
                                <a href="" class="text-primary"><i class="uil uil-edit"></i></a>
                                <a href="" class="text-danger"><i class="uil uil-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
