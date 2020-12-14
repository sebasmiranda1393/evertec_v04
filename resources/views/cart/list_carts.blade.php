@extends('layouts.app')
@section('content')
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:20%" class="text-center" bgcolor="#00bfff">mis compras</th>
            <th style="width:20%" class="text-center" bgcolor="#00bfff">fecha de la compra</th>
            <th style="width:20%" class="text-center" bgcolor="#00bfff">valor de mi compra</th>
            <th style="width:20%" class="text-center" bgcolor="#00bfff">Estado de la compra</th>
            <th style="width:20%" class="text-center" bgcolor="#00bfff">ver mi compra</th>


        </tr>
        </thead>
        <tbody>

        <?php $total = 0 ?>


        @for ($i = 0; $i < count($carts); $i++)


            <tr>
                <td class="text-center" data-th="id">mi compra Nª{{ $carts[$i]['id'] }}</td>
                <td class="text-center" data-th="Created_at">{{ $carts[$i]['created_at'] }}</td>
                <td class="text-center"><strong>Total ${{ $carts[$i]['total']}}</strong></td>
                <td data-th="created_at">{{ $status[$i]->message() }}</td>
                <td class="text-center">
                    <a href="{{ URL::route('cart.show', $carts[$i]['id']) }}">
                        <i class="fas fa-eye  fa-3x"></i></a>
                </td>

            </tr>
        @endfor

        </tbody>
    </table>
    <div class="col-sm-12">
        <a href="{{ URL::route('home.index') }}" class="btn btn-primary">inicio </a>
    </div>
@endsection
