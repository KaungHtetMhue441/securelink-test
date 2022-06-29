@extends('layout.app')
@section('title', 'home')
@section('content')
    <div class="container-fluid  mt-2">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Edit</h3>
                        {{ session()->get('fail') }}
                        @if (isset($info))
                            {{ dd(info) }}
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('info.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" value="{{$data->name}}" id="name" name="name">
                                    </div>

                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-2">
                                        <label for="email">email</label>
                                        <input type="text" class="form-control" value="{{$data->email}}" id="email" name="email">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-2">
                                        <label for="country">country</label>
                                        <input type="text" class="form-control" value="{{$data->country}}" id="country" name="country">
                                    </div>
                                    @error('country')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-2">
                                        <label for="phone">Phone</label>
                                        <input type="number" class="form-control" value="{{$data->phone}}" id="phone" name="phone">
                                    </div>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-2">
                                        <label for="photo">Photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo">
                                    </div>
                                    @error('photo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-primary float-left">update</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
