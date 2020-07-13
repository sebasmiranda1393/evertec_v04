@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('posts.update', $user->id) }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name"  name="name" placeholder="ingrese nombre"
                                value={{ $user->name}}>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email"  name="email"placeholder="ingresa email"
                               value={{ $user->email}}>
                            </div>

                            <div class="form-group">
                                <label for="email">Password</label>
                                <input type="password" class="form-control" id="password"  name="password"placeholder="ingresa password"
                                       value={{ $user->password}}>
                            </div>

                            <div class="form-group">
                                <label for="status">Change status</label>
                                <select class="form-control" id="status"  name="status">
                                    <option value="1">Habilitar</option>
                                    <option value="0">Desabilitar</option>
                                </select>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class=" col-sm-3">
                                </div>
                                <div class=" col-sm-4">
                                    <a href="{{ URL::route('posts.back') }}" class="btn btn-primary btn-lg"> Atras </a>
                                </div>
                                <div class="col-sm-4">
                                    <input type="submit" class=" btn btn-primary btn-lg" value="guardar" />
                                </div>
                                <div class=" col-sm-1">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
