@extends('layouts.app')

@section('title', 'Home | Product App')

@section('content')
    <div class="container movie-wrapper">
        <div class="row">
            @foreach ($products as $product)
                <div class="">
                    <div class="">
                        <h1>{{ $product->title }}</h1>
                        <p>{{ $product->description }}</p>
                        <span class="badge bg-warning">{{ $product->category->title }}</span>
                        <span>Tahun Terbit: {{ $product->tahun_rilis }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
