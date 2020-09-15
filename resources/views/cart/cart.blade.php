@extends('layouts.app')
@section('content')
    <form action="{{ route('cart.update') }}"  method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:45%" class="text-center">Producto</th>
                <th style="width:10%">Precio</th>
                <th style="width:7%">cantidad</th>
                <th style="width:12%" class="text-center">Subtotal</th>
                <th style="width:28%"></th>
            </tr>
            </thead>
            <tbody>

            <?php $total = 0 ?>

            @if(session('cart'))
                @foreach(session('cart') as $id => $details)

                    <?php $total += $details['price'] * $details['quantity'] ?>

                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img
                                        src="{{ asset('image/products/'.$details['photo'])}}"
                                        width="100" height="100" class="img-responsive"/>
                                </div>

                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $details['price'] }}</td>


                        <td data-th="Quantity">
                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity"/>
                        </td>

                        <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                        <td class="actions" data-th="">

                            <div class="row">
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ URL::route('cart.delete') }}" type="submit"
                                       class="btn btn-danger "> eliminar</a>
                                </div>
                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>
            <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total {{ $total }}</strong></td>
            </tr>
            </tfoot>
        </table>


        <td>
            <a href="{{ URL::route('product.customer') }}" class="btn btn-primary">
                <i class="fa-angle-left"></i>siga su compra</a>

            <a href="{{ URL::route('product.customer') }}" type="submit"
               class="btn btn-danger "> vaciar carrito</a>


            <a href="{{ URL::route('saveCart') }}" class="btn btn-primary">
                <i class=" fa-angle-left"></i>guardar carrito</a>
        </td>


@endsection
