@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content">
            <body style="background-color:#AED6F1;"></body>
            @can('reports')

            <div class="m-2">
                <div class="card">
                    <div class="col m-1">
                        <a href="{{ route('excel.exportProducts') }}" class="btn btn-primary "> Exportar productos
                            excel</a>
                    </div>
                </div>
            </div>

            <div class="m-2">
                <div class="card">
                    <div class="col m-1">
                        <a href="{{ route('excel.index') }}" class="btn btn-primary "> importar todos los productos </a>
                    </div>
                </div>
            </div>

            <div class="m-2">
                <form action="{{ route('reportByDateTopSellingProduct')}}" enctype="multipart/form-data" method="POST">
                    {{csrf_field()}}
                    <div class="card">
                        <div class="col m-1">
                            <label>Producto mas vendido: </label>
                            <input id="date" name="date" type="date" required autocomplete="Producto mas vendido:">
                            <input type="submit" class=" btn btn-primary" value="Descargar"/>
                        </div>
                    </div>
                </form>
            </div>


            <div class="m-2">
                <div class="card">
                    <div class="col m-1">
                        <form action="{{ route('stockProducts')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <label>stock de productos</label>
                            <br/>
                            <input id="cantidad" name="cantidad" type="number" required autocomplete="stock de productos">
                            <br/>

                            <br/>
                            <input onchange="myFunction(this)" type="checkbox" name="mayor" id="mayor"  value=1>stock de productos con __ o mas unidades  <br/>
                            <input onchange="myFunction(this)" type="checkbox" name="menor" id="menor" value=2>stock de productos con __ o menos unidades
                            <br/>

                            <input type="submit" class=" btn btn-primary" value="Descargar"/>
                        </form>
                    </div>
                </div>
            </div>

            <div class="m-2">
                <form action="{{ route('less_quantity')}}" enctype="multipart/form-data" method="POST">
                    {{csrf_field()}}
                    <div class="card">
                        <div class="col m-1">
                            <label>top __ con menor stock: </label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad"
                                   placeholder="cantidad de producto" required autocomplete="top __ con menor stock:">
                            <input type="submit" class=" btn btn-primary" value="Descargar"/>
                        </div>
                    </div>
                </form>
            </div>



            <div class="m-2">
                <form action="{{ route('higher_quantity')}}" enctype="multipart/form-data" method="POST">
                    {{csrf_field()}}
                    <div class="card">
                        <div class="col m-1">
                            <label>top __ con mayor stock: </label>
                            <input id="cantidad" name="cantidad" type="number" required autocomplete="top __ con mayor stock:">
                            <input type="submit" class=" btn btn-primary" value="Descargar"/>
                        </div>
                    </div>
                </form>
            </div>


            <div class="col-md-2">
                <a href="{{ route('product.index') }}" class="btn btn-primary "> Atras </a>
            </div>
        </div>
    </div>
    @else
        <div class="card">
            <div class="col m-1">
                <label>NO TIENE PERMISOS PARA ESTA FUNCION </label>
            </div>


        <div class=" col-sm-1">
            <a href="{{ route('home.index') }}" class="btn btn-primary "> Atras </a>
        </div>
    @endcan

@endsection
