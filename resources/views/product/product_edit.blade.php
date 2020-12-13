@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <body style="background-color:#AED6F1;">

                </body>
                <div class="card">
                    <div class="card-header">Edite el producto aqui</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('product.update', $product)}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                           @method('PUT')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre producto1</label>

                                <div class="col-md-6">
                                    <textarea required id="name" name="name" cols="30" rows="1"
                                              class="form-control">{{ $product->name}} </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">Descripcion</label>

                                <div class="col-md-6">
                                    <textarea required id="description" name="description" cols="30" rows="5"
                                              class="form-control">{{ $product->description}} </textarea>

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
                                    <input id="sale_price" type="number"
                                           class="form-control  @error('password') is-invalid @enderror"
                                           value={{ $product->sale_price}} name="sale_price"
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
                                    <input id="purchase_price" type="number" class="form-control"
                                           name="purchase_price" value={{ $product->purchase_price}} required
                                           autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                    Existencia</label>

                                <div class="col-md-6">
                                    <input id="available" type="number" class="form-control"
                                           name="available" value={{ $product->available}}  required
                                           autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right"> Cambiar
                                    estado </label>
                                <div class="col-md-6">
                                    <select class="form-control" id="status" name="status">
                                        <option value=1>Habilitar</option>
                                        <option value=0>Desabilitar</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <div class="col-md-6 offset-4 mt-3 custom-file">
                                    <input id="image" type="file" name="image"/>
                                </div>
                            </div>

                            <div class="form-group row mb-0 mt-5">
                                <div class="col-sm-3 offset-4">
                                    <a href="{{ route('product.index') }}" class="btn btn-primary "> Atras </a>
                                </div>
                                <div class="col-sm-3">
                                    <input type="submit" class=" btn btn-primary" value="guardar"/>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
