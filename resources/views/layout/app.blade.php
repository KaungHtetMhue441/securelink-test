<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css') }}">
</head>

<body>
    <div class="container-fluid shadow shadow-sm ">
        <div class="container p-3">

        <div class="row justify-content-between">

            <div class="col-4">
               <a href="{{route('home')}}" class="link-info" target="_blank" rel="noopener noreferrer"> <h4>Home</h4></a>
            </div>
            <div class="col-8 d-flex justify-content-end">
             <h4 class="d-inline-block pl-5 text-info">Kaunghtetmhue</h4>
             <div class="p-3"></div>
             @if(session()->has('LoggedUser'))
             <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('post')
                <button type="submit" class="btn btn-primary pr-5">Logout</button>
            </form>
             @else
                 <div class=" d-flex">
                    <a href="/user/login" class="btn btn-primary">login</a>
                   <div class="p-3"></div>
                    <a href="/user/register" class="btn btn-primary">Register</a>
                 </div>
             @endif
            
            </div>
        </div>
    </div>

    </div>
    @yield('content')
    <script src="{{asset("js/app.js")}}"></script>
</body>

</html>
