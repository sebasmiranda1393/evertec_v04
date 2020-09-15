@extends('layouts.app')
@section('content')
    <div class="rowlist-group-vertical pt-5">
        <div class="row list-group-vertical pt-5">
        <div class="col-md-4 offset-2">
            <li class="nav-item nav-profile border-bottom ">
                <a href="#" class="table table-hover table-condensed ">
                    <tr>
                        <div class="row">
                            <div class="col-sm-6  col-md-6 nav-profile-image">
                                <img src="{{ asset('image/face1.jpg') }}" alt="profile">
                                <span class="text-secondary icon-sm text-center"> <FONT SIZE=6>
                    {{ Auth::user()->name }}</span>

                            </div>
                        </div>
                    </tr>
                </a>
            </li>
        </div>
    </div>

        <div class="col-md-6 offset-4">
            <H1> TU TIENDA CADA VEZ MAS CERCA! </H1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 offset-2">
            <div class="row">
                <div class="col-md-4 offset-1">
                    <form action="{{ route('product.search', 1) }}" method="GET" class="form-container">
                        {{ csrf_field() }}
                        <div class="row list-group-horizontal pt-5">
                            <div class="col-md-6 col-sm-6 offset-1">
                                <div class="product-grid2">
                                    <div class="product-image2">
                                        <a href="#">
                                            <img src="{{ asset('image/products/'.$product->productimg)}}"> </a>
                                        <a class="add-to-cart" href="{{ route('cart.add-to-cart', $product->id) }}"
                                        >Añadir al carro</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 pt-5">
                    <div class="row list-group-vertical pt-5">
                        <div class="product-content">
                            <h3 class="title">Nombre:<a href="#">{{ $product->name}}</a></h3>
                            <h3 class="title">Nescripcion:<a href="#">{{ $product->description}}</a></h3>
                            <span class="price">Valor: ${{ $product->sale_price}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ URL::route('product.customer') }}" class="btn btn-primary">
                <i class="fa-angle-left"></i>ver mas productos</a>
            <hr>
        </div>
    </div>

@endsection
