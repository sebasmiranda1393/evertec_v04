@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row ">
            <body style="background-color:#AED6F1;">
            @can('role.edit')
            <table class="table mt-5">
                <thead>
                <tr>
                    <th style="width:20%" class="text-center" scope="col">id</th>
                    <th style="width:20%" class="text-center" scope="col">Nombre</th>

                </tr>
                </thead>
                <tbody id="ejemplo">
                @foreach ($permissions as $rol)
                    <tr>
                        <td class="text-center"> {{ $rol->id}}</td>
                        <td class="text-center">{{ $rol->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class=" col-sm-1">
                <a href="{{ URL::route('rol.index') }}" class="btn btn-primary "> Atras </a>
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

