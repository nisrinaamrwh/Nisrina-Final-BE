@extends('layouts.app')

@section('title', 'Register | Movie App')

@section('content')
    <div class="container mt-5">
        <div class="col-md-4 bg-white p-3 rounded">
            <form action="/register" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">
                        Nama Lengkap
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="">
                        Email
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </label>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="">
                        Password
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Confirm your Password">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
