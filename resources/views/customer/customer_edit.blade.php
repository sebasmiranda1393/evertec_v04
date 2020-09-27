@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <body style="background-color:#B5D4C8;">

                    </body>
                    <div class="card-header">Editar cliente</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('customers.update', $user->id) }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <textarea required id="name" name="name"  cols="30" rows="1"
                                          class="form-control" >{{ $user->name}} </textarea>

                            </div>
                            <div class="form-group">
                                <label for="email">Correo electronico</label>
                                <input type="email" class="form-control" id="email"  name="email"placeholder="ingresa email"
                                       value={{ $user->email}}>
                            </div>


                            <div class="form-group">
                                <label for="status">Cambiar estado</label>
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
                                  <a  href="{{ route('customers.back') }}"
                                       class="btn btn-primary btn-lg"> Atras </a>
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
