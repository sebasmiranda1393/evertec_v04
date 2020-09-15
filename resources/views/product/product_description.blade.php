@extends('layouts.app')
@section('content')

    <form action="{{ route('product.search', 1) }}" method="GET" class="form-container">
    {{ csrf_field() }}

        <td>
            <a href="{{ URL::route('cart.cart') }}" class="btn btn-primary">
                <i class="fa fa-angle-left"></i>mis productos</a>
        </td>
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
                        <a class="add-to-cart" href="{{ route('cart.add-to-cart', $product->id) }}">Añadir al carro</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="#">{{ $product->name}}</a></h3>
                        <span class="price">${{ $product->description}}</span>
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
@endsection
