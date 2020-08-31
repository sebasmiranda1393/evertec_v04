@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('product.id') }}" method="GET" class="form-horizontal">
            {{ csrf_field() }}
        </form>
        <div class="row list-group-horizontal pt-5">
            @foreach ($products as $product)
                <div class="col-md-2 col-sm-2 offset-1">
                    <div class="product-grid2">
                        <div class="product-image2">
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{ $product->name}}</a></h3>
                            <span class="price">${{ $product->sale_price}}</span>
                            <span class="price">{{ $product->description}}</span>
                            <a class="add-to-cart" href="">Añadir al carro</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
                <div class="row p-3 pb-4">
                    <div class=" col-sm-1">
                        <a href="{{ URL::route('customer.back') }}" class="btn btn-primary "> Atras </a>
                    </div>
                </div>
    </div>

@endsection
