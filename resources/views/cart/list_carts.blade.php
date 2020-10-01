@extends('layouts.app')
@section('content')
    <form action="{{ route('cart.update') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:25%" class="text-center" bgcolor="#00bfff">mis compras</th>
                <th style="width:25%" class="text-center" bgcolor="#00bfff">fecha de la compra</th>
                <th style="width:25%" class="text-center" bgcolor="#00bfff">valor de mi compra</th>
                <th style="width:25%" class="text-center" bgcolor="#00bfff">ver mi compra</th>


            </tr>
            </thead>
            <tbody>

            <?php $total = 0 ?>

            @foreach($carts as $id => $details)


                <tr>
                    <td class="text-center" data-th="id">mi compra Nª{{ $details['id'] }}</td>
                    <td class="text-center" data-th="Created_at">{{ $details['created_at'] }}</td>
                    <td class="text-center"><strong>Total ${{ $details['total']}}</strong></td>
                    <td class="text-center">
                        <a href="{{ URL::route('myCarts.carts', $details->id) }}">
                         <i class="fas fa-eye  fa-3x"></i></a>
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="col-sm-12">
        <a href="{{ URL::route('product.customer') }}" class="btn btn-primary">inicio </a>
        </div>
@endsection
