@extends('../layout.app')
@section('title', 'home')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('success') }}</strong>
                            <button type="button" class="close btn btn-sm" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('fail'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('fail') }}</strong>
                        <button type="button" class="close btn btn-sm" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <div class="card-body">
                        <form action="/user/login" method="POST">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="email"> Enter your Email</label>
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-3">
                                        <label for="password"> Enter Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    @if (session()->has('password'))
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>{{ session()->get('password') }}</strong>
                                            <button type="button" class="close btn btn-sm" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary float-left">login</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
