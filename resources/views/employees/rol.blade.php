@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row ">
            <body style="background-color:#AED6F1;">
            <table class="table mt-5">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombre</th>
                </tr>
                </thead>
                <tbody id="ejemplo">
                @foreach ($roles as $rol)
                    <tr>

                        <td>{{ $rol->id}}</td>
                        <td>{{ $rol->name}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            </body>
        </div>
    </div>
@endsection
