@extends('layouts.app')
@section('content')
    <form action="{{ route('cart.update') }}" method="POST" class="form-horizontal">
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

                @foreach($carts as $id => $details)


                    <tr>
                        <td > <div class="col-sm-3 hidden-xs"><img
                                src="{{ asset('image/products/'.$details['productimg'] )}}"
                                width="100" height="100" class="img-responsive"/>
                        </div></td>

                        <td data-th="Price">{{ $details['id'] }}</td>
                        <td data-th="Price">{{ $details['name'] }}</td>
                        <td data-th="Price">${{ $details['sale_price'] }}</td>
                        <td data-th="Price">{{ $details['quantity'] }}</td>
                        <td data-th="Price">{{ $details['created_at'] }}</td>


                    </tr>
                @endforeach

            </tbody>
        </table>




@endsection
