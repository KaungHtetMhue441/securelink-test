@extends('layout.app')
@section('title', 'home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h3>{{$data->name}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 my-border justify-content-center align-items-center p-5">
                            <img src="{{ asset('storage/photo/' . $data->photo) }}" class="photo-lg"
                        alt="">
                        </div>
                        <div class="col-8 align-items-center p-5">
                            <h4>Email - {{$data->email}}</h4>
                            <h4>Country - {{$data->coutry}}</h4>
                            <h4>Phone - {{$data->phone}}</h4>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection