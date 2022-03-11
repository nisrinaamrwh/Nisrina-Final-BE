{{-- INI HALAMAN KALAU UDAH LOGIN --}}
@extends('layouts.app')

@section('content')
    <h1>Halo {{ Auth::user()->name }}</h1>
    <h3>Kamu adalah {{ Auth::user()->role }}</h3>
@endsection
