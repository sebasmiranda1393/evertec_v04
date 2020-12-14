@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row ">
            <body style="background-color:#AED6F1;">
            @can('role.edit')
            <table class="table mt-5">
                <thead>
                <tr>
                    <th style="width:30%" class="text-center" scope="col">id</th>
                    <th style="width:30%" class="text-center" scope="col">Nombre</th>
                    <th style="width:30%" class="text-center" scope="col">ver permisos</th>
                    <th style="width:30%" class="text-center" scope="col">Editar permisos</th>

                </tr>
                </thead>
                <tbody id="ejemplo">
                @foreach ($roles as $rol)
                    <tr>

                        <td class="text-center"> {{ $rol->id}}</td>
                        <td class="text-center">{{ $rol->name}}</td>
                        <td class="text-center">
                            <a href="{{ URL::route('rol.show', $rol->id) }}">
                                <i class="fas fa-eye  fa-3x"></i></a></td>

                        <td class="text-center">
                            <a href="{{ URL::route('rol.edit', $rol->id) }}">
                                <i class="fas fa-edit fa-3x"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class=" col-sm-1">
                <a href="{{ URL::route('product.index') }}" class="btn btn-primary "> Atras </a>
            </div>

            </body>
        </div>
    </div>

    @else
        <div class="card">
            <div class="col m-1">
                <label>NO TIENE PERMISOS PARA ESTA FUNCION </label>
            </div>


            <div class=" col-sm-1">
                <a href="{{ URL::route('home.index') }}" class="btn btn-primary "> Atras </a>
            </div>
    @endcan

@endsection
