@extends('layouts.app')
@section('title', 'Manage Product | ProductApp')

@section('content')
    {{-- CREATE MOVIE --}}
    @include('products.create', $categories)

    <div class="container mt-5">
        <div class="col-md-9 bg-light rounded p-3">
            {{-- HEADER --}}
            <h3 class="text-dark">Manage Barang</h3>
            <p class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni facere, consectetur
                maiores maxime laborum</p>
            <hr>

            {{-- TABLE --}}
            @if (Auth::user()->role == 'Member')
                <a href="#" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#createProductModal">
                    <i class="uil uil-plus-circle me-1"></i>
                    Tambah Barang
                </a>
            @endif
            @if (session('success_msg'))
                <div class="alert alert-success mt-3">{{ session('success_msg') }}</div>
            @endif

            @if ($products->count() != 0)
                <table class="table table-success table-striped mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Description</th>
                            <th>Release Year</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><img src="{{ asset('storage/products/' . $product->thumbnail) }}" width="100"></td>
                                <td>
                                    <span class="d-block">{{ $product->title }}</span>
                                    <span class="badge bg-dark me-2">{{ $product->category->title }}</span>
                                    <span class="badge bg-primary">{{ $product->tahun_rilis }}</span>
                                    @if ($product->status == 'Pending')
                                        <span class="badge bg-warning"><i class="uil uil-hourglass me-1"></i>Menunggu Persetujuan</span>
                                    @else
                                        <span class="badge bg-success"><i class="uil uil-check-circle me-1"></i>Dipublikasikan</span>
                                    @endif
                                </td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $poduct->tahun_rilis }}</td>
                                <td>{{ $product->user->name }}</td>
                                <td>
                                    @if (Auth::user()->role == 'Member')
                                        <a href="{{ route('editProduct', $product->id) }}" class="text-primary"><i
                                                class="uil uil-edit"></i></a>
                                    @endif
                                    <a href="" class="text-primary"
                                        onclick="event.preventDefault();document.getElementById('accept-form-'+{{ $product->id }}).submit()">
                                        <i class="uil uil-check-circle"></i>
                                        <form action="{{ route('acceptProduct', $product->id) }}" method="POST"
                                            id="accept-form-{{ $product->id }}" class="d-none">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    </a>
                                    <a href="" class="text-danger"
                                        onclick="event.preventDefault();document.getElementById('delete-form-'+{{ $product->id }}).submit()">
                                        <i class="uil uil-trash-alt"></i>
                                        <form action="{{ route('deleteProduct', $product->id) }}" method="POST"
                                            id="delete-form-{{ $product->id }}" class="d-none">
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
                    Product masih kosong nih :(
                </div>
            @endif
        </div>
    </div>
@endsection
