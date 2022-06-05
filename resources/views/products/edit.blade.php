@extends('layouts.app')
@section('title', 'Edit Product | ProductApp')

@section('content')

    <div class="container mt-5">
        <div class="col-md-9 bg-light rounded p-3">
            {{-- HEADER --}}
            <h3 class="text-dark">Edit Barang</h3>
            <p class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni facere, consectetur
                maiores maxime laborum</p>
            <hr>

            @if (session('success_msg'))
                <div class="alert alert-success mt-3">{{ session('success_msg') }}</div>
            @endif

            <form action="{{ route('updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                        placeholder="Gambar barang..." name="thumbnail" value="{{ old('thumbnail') ? old('thumbnail') : $product->thumbnail }}">
                    @error('thumbnail')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Nama Barang..."
                        name="title" value="{{ old('title') ? old('title') : $product->title }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi Barang</label>
                    <textarea rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi Barang..."
                        name="description">
                        {{ old('description') ? old('description') : $product->description }}
                    </textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tahun Rilis</label>
                    <input type="number" class="form-control @error('tahun_rilis') is-invalid @enderror"
                        placeholder="Tahun Rilis..." name="tahun_rilis" value="{{ old('tahun_rilis') ? old('tahun_rilis') : $product->tahun_rilis }}">
                    @error('tahun_rilis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="genre" class="form-control @error('genre') is-invalid @enderror">
                        @foreach ($categoriess as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </form>
        </div>
    </div>
@endsection
