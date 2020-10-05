@extends('layouts.app')
@section('content')
    <form action="{{ route('cart.store') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:45%" class="text-center" bgcolor="#00bfff">Producto</th>
                <th style="width:10%" bgcolor="#00bfff">Precio</th>
                <th style="width:7%" bgcolor="#00bfff">cantidad</th>
                <th style="width:12%" class="text-center" bgcolor="#00bfff">Subtotal</th>
                <th style="width:28%" bgcolor="#00bfff"></th>
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
                                <div class="col-sm-3 hidden-xs">
                                    @if($details['photo']==null)
                                        <img src="{{ asset('image/imagen-no-disponible.png') }}"
                                             width="100" height="100" class="img-responsive"/>
                                    @else
                                        <img
                                            src="{{ asset('image/products/'.$details['photo'])}}"
                                            width="100" height="100" class="img-responsive"/>
                                    @endif
                                </div>

                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $details['price'] }}</td>


                        <td data-th="Quantity">
                            {{ $details['quantity'] }}
                        </td>

                        <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>

                        <div class="row">
                            <td class="actions" data-th="">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <a href="{{ route('order.delete',$details['id'])  }}" type="submit"
                                               class="btn btn-danger "> eliminar</a>
                                        </div>

                                        <div class="col-md-3">

                                            <a href="{{ URL::route('order.increaseProduct',$details['id'])  }}"
                                               type="submit"
                                               class="btn btn-danger"> +</a>
                                        </div>

                                        <div class="col-md-3">

                                            <a href="{{ URL::route('order.decreaseProduct',$details['id'])  }}"
                                               type="submit"
                                               class="btn btn-danger "> -</a>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </div>
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
            <a href="{{ URL::route('home.index') }}" class="btn btn-primary">
                continue comprando</a>


            <a href="{{ URL::route('order.empty', 1) }}" class="btn btn-primary">
                vaciar carrito</a>

            <input type="submit" class=" btn btn-primary" value="guardar carrito"/>


        </td>
    </form>
        @jquery
        @toastr_js
        @toastr_render
@endsection
