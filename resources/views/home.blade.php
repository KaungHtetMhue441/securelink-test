@extends('layout.app')
@section('title', 'home')
@section('content')
    <div class="container-fluid  mt-2">
        <div class="row justify-content-between">
            <div class="col-4">
                <div class="card shadow shadow-sm">
                    <div class="card-header text-center">
                        <h3>Create People information</h3>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{session()->get('success')}}</strong>
                            <button type="button" class="close btn btn-sm" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        @endif
                        <form action="{{ route('info.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control form-control-sm" id="name" name="name">
                                    </div>

                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-2">
                                        <label for="email">email</label>
                                        <input type="text" class="form-control form-control-sm" id="email" name="email">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-2">
                                        <label for="country">country</label>
                                        <input type="text" class="form-control form-control-sm" id="country" name="country">
                                    </div>
                                    @error('country')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-2">
                                        <label for="phone">Phone</label>
                                        <input type="password" class="form-control form-control-sm" id="phone" name="phone">
                                    </div>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-2">
                                        <label for="photo">Phone</label>
                                        <input type="file" class="form-control form-control-sm" id="photo" name="photo">
                                    </div>
                                    @error('photo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-primary float-left">Register</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card shadow shadow-sm">
                    <div class="card-header">
                        User information
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>coountry</th>
                                    <th>Phone No</th>
                                    <th>Photo</th>
                                    <th colspan="4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->country }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td><img src="{{ asset('storage/photo/' . $data->photo) }}" class="photo"
                                                alt=""></td>
                                        <td colspan="3">
                                            <div class="">
                                                <div class="mr-2">
                                                    <form action="{{ route('info.delete', $data->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary">delete</button>
                                                    </form>
                                                </div>
                                                <div class="mr-2">
                                                    <a href="{{ route('info.edit', $data->id) }}">
                                                        edit
                                                    </a>
                                                </div>
                                                <div class="mr-2">
                                                    <a href="{{ route('info.show', $data->id) }}">
                                                        show
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Nothing to show</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            {{ $datas->appends(request()->all())->links() }}
                            <p class="font-weight-bold mb-0 h4">Total : {{ $datas->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
