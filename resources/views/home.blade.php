@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row ">
            <body style="background-color:#B5D4C8;">

            </body>
            <div class="col-md-10 offset-md-2">
                <div class="card-header">LISTA DE CLIENTES</div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
            <div class="row">
                @include('layouts.sideMenu')
                <div class="col-md-10">
                    <table class="table mt-5">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo electronico</th>
                            <th scope="col">Fecha creado</th>
                            <th scope="col">Fecha actualizacion</th>
                            <th scope="col">Editar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)

                            <tr>
                                <th scope="row">{{ $user->id}}</th>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->created_at}}</td>
                                <td>{{ $user->updated_at}}</td>
                                <td>
                                    @if($user->status==true)
                                        Habilitado
                                    @endif
                                    @if($user->status==false)
                                        Deshabilitado
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('customer.edit', $user->id) }}"
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
