@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-10 offset-md-2">


                <div class="input-group md-form form-sm form-1 pl-0">
                    <div class="input-group-prepend">
    <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fas fa-search text-white"
                                                                        aria-hidden="true"></i></span>
                    </div>
                    <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search">
                </div>
            </div>
        </div>

        <div class="row" >
            @include('layouts.sideMenu')
            <div class="col-md-10">
            <table class="table mt-5">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id}}</th>
                        <td>{{ $product->product}}</td>
                        <td>{{ $product->description}}</td>
                        <td>{{ $product->price}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
