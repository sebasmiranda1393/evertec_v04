@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('product.search', 1) }}" method="GET" class="form-horizontal">
            {{ csrf_field() }}
            <div class="row ">
                <div class="col-md-3 offset-md-2">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="namesearch" name="namesearch"
                               placeholder="Buscar por nombre">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <input id="valorsearch" name="valorsearch" type="text" class="form-control"
                               placeholder="Buscar por valor venta">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <input id="categorysearch" name="categorysearch" type="text" class="form-control"
                               placeholder="Buscar por categoria">
                    </div>
                </div>
                <div class="col-sm-1">
                    <input type="submit" class=" btn btn-primary " value="Buscar" />
                </div>

            </div>

        </form>
        <h3 class="h3">shopping Demo-2 </h3>
        <div class="row list-group-horizontal">
            @foreach ($products as $product)
                <div class="col-md-3 col-sm-3">
                    <div class="product-grid2">
                        <div class="product-image2">
                            <a href="#">
                                <img class="mr-5" src="{{ asset('image/products/'.$product->productimg)}}" width="100"
                                     height="100" alt="profile"> </a>
                            <a class="add-to-cart" href="">Add to cart</a>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{ $product->name}}</a></h3>
                            <span class="price">${{ $product->sale_price}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <hr>
@endsection
