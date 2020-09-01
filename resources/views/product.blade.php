@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('product.search', 0) }}" method="GET" class="form-horizontal">
            {{ csrf_field() }}
            <body style="background-color:#AED6F1;">

            </body>
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
                <div class="col-sm-1">
                    <input type="submit" class=" btn btn-primary " value="Buscar" />
                </div>

                <div class="col-md-1">
                    <a href="{{ route('product.create') }}" class="btn btn-primary "> Crear </a>
                </div>

            </div>

        </form>
        <div class="row">
            @include('layouts.side_menu')
            <div class="col-md-10">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Valor Venta</th>
                        <th scope="col">Valor Compra</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Editar</th>
                    </tr>
                    </thead>
                    <tbody id="ejemplo">
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id}}</th>
                            <td>{{ $product->name}}</td>
                            <td>{{ $product->description}}</td>
                            <td>{{ $product->sale_price}}</td>
                            <td>{{ $product->purchase_price}}</td>
                            <td>{{ $product->available}}</td>
                            <td>
                                @if($product->status==true)
                                    Habilitado
                                @endif
                                @if($product->status==false)
                                    Deshabilitado
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('product.edit', $product->id) }}"
                                   class="label label-warning">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
