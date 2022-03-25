@extends('layouts.app')
@section('title', 'Edit Genre | MovieApp')

@section('content')
    <div class="container mt-5">
        <div class="col-md-7 bg-light rounded p-3">
            {{-- HEADER --}}
            <h3 class="text-dark">Edit Genres</h3>
            <p class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni facere, consectetur
                maiores maxime laborum</p>
            <hr>

            {{-- CONTENT --}}
            <form action="{{ route('updateGenre', $genre->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Judul Genre</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Type genre here..." name="title" value="{{ old('title') ? old('title') : $genre->title }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <a href="{{ url('/genre') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </form>
        </div>
    </div>
@endsection
