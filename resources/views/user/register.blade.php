@extends('layout.app')
@section('title', 'home')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Register</h3>
                        {{ session()->get('fail') }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>

                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-2">
                                        <label for="email">email</label>
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-2">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-2">
                                        <label for="confirmpassword">Conform password</label>
                                        <input type="password" class="form-control" id="confirmpassword"
                                            name="confirmpassword">
                                    </div>
                                    @error('confirmpassword')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-primary float-left">Register</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
