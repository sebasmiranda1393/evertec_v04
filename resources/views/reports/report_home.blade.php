@extends('layouts.app')
@section('content')
    <form action="{{ route('download_report') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <table id="products" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th class="text-center" style="width:15%" class="text-center">id del Producto</th>
                <th class="text-center" style="width:30%">Nombre del producto</th>
                <th class="text-center" class="text-center" style="width:30%">descripción del producto</th>
                <th class="text-center" style="width:25%" class="text-center">cantidad total</th>

            </tr>
            </thead>
            <tbody>

            @foreach($products as $row => $data )

                <input id="product[]" name="product" type="hidden" value="{{$products}}">

                <tr>
                    <td class="text-center" data-th="id">{{ $data['id'] }}</td>
                    <td class="text-center" data-th="nombre del producto">{{ $data['name'] }}</td>
                    <td class="text-center" data-th="descripción del producto">{{ $data['description'] }}</td>
                    <td class="text-center" data-th="cantidad total">{{ $data['available'] }}</td>

                </tr>
            @endforeach

            </tbody>

        </table>

        <div class="col-sm-1">
            <input type="submit" class=" btn btn-primary" value="Descargar"/>
        </div>


    </form>

    <div class="col-sm-3">
        <a href="{{ route('back') }}" class="btn btn-primary "> atras </a>
    </div>
    </div>


@endsection
