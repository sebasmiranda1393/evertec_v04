@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cree un nuevo producto</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre producto</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name')
                                        is-invalid @enderror" name="name" value=""
                                           required autocomplete="name" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Descripcion</label>

                                <div class="col-md-6">
                                    <textarea required id="descripcion" name="descripcion" cols="30" rows="5"
                                              class="form-control"></textarea>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>"alerta email"</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Precio venta</label>

                                <div class="col-md-6">
                                    <input id="password" type="number"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>error password</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                    Precio compra</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="number" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                    EXistencia</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="number" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-6 offset-4 mt-3">
                                    <input type="file" name="photo[]"/>
                                </div>
                            </div>
                            <div class="form-group row mb-0 mt-5">
                                <div class="col-sm-3 offset-4">
                                    <a href="{{ route('product') }}" class="btn btn-primary "> Atras </a>
                                </div>
                                <div class="col-sm-3">
                                    <input type="submit" class=" btn btn-primary" value="Guardar"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
