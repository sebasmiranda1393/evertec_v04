@extends('layouts.app')
@section('content')

    <form action="{{ route('product.search', 1) }}" method="GET" class="form-container">
        {{ csrf_field() }}
        <div class="row p-3 pb-4">
            <div class="col-md-3 offset-1">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="namesearch" name="namesearch"
                           placeholder="Buscar por nombre ">
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group mb-3">
                    <input id="valorsearch" name="valorsearch" type="text" class="form-control"
                           placeholder="Buscar por precio ">
                </div>
            </div>


            <div class="col-sm-1">
                <input type="submit" class=" btn btn-primary " value="Buscar"/>
            </div>


            <div class="col-sm-">
                <a type="submit" class=" btn btn-primary "
                   href="{{ URL::route('cart.cart') }}">mis Productos</a>
            </div>
        </div>


    </form>
    <div class="row list-group-horizontal pt-5">
        @foreach ($products as $product)
            <div class="col-md-2 col-sm-2 offset-1">
                <div class="product-grid2">
                    <div class="product-image2">
                        <a href="#">

                            @if($product->productimg==null)
                                <img src="{{ asset('image/imagen-no-disponible.png') }}">

                            @else
                                <img src="{{ asset('image/products/'.$product->productimg)}}"> </a>
                        @endif

                        <a class="add-to-cart"
                           href="{{ route('cart.add-to-cart', $product->id) }}"
                        >Añadir al carro </a>

                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="#">{{ $product->name}} </a></h3>
                        <span class="price">${{ $product->sale_price}}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row list-group-horizontal pt-4">
        <div class="col-md-4 offset-5 ">
            {{ $products->render() }}
        </div>
    </div>
    <hr>
    @jquery
    @toastr_js
    @toastr_render
@endsection
