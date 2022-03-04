@extends('layouts.app')

@section('title', 'Login | Movie App')

@section('content')
    <div class="container mt-5">
        @if (session()->has('success_status'))
            <div class="alert alert-success">
                {{ session('success_status') }}
            </div>
        @elseif (session()->has('error_status'))
            <div class="alert alert-danger">
                {{ session('error_status') }}
            </div>
        @endif

        <div class="col-md-4 bg-white p-3 rounded">
            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">
                        Email
                        @error('email')
                            <small class="text-danger">*{{ $message }}</small>
                        @enderror
                    </label>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="">
                        Password
                        @error('password')
                            <small class="text-danger">*{{ $message }}</small>
                        @enderror
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
