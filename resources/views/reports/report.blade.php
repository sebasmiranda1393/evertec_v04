@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content">
            <body style="background-color:#AED6F1;"></body>

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
                        <a href="{{ route('excel.index') }}" class="btn btn-primary "> importar productos excel </a>
                    </div>
                </div>
            </div>

            <div class="m-2">
                <form action="{{ route('reportByDateTopSellingProduct')}}" enctype="multipart/form-data" method="POST">
                    {{csrf_field()}}
                    <div class="card">
                        <div class="col m-1">
                            <label>Producto mas vendido: </label>
                            <input id="date" name="date" type="date">
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
                            <label>Productos con mayor cantidad unidades: </label>
                            <input id="cantidad" name="cantidad" type="number">
                            <input type="submit" class=" btn btn-primary" value="Descargar"/>
                        </div>
                    </div>
                </form>
            </div>



            <div class="m-2">
                <form action="{{ route('mayorUnidades')}}" enctype="multipart/form-data" method="POST">
                    {{csrf_field()}}
                    <div class="card">
                        <div class="col m-1">
                            <label>Productos con mas de X unidades: </label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad"
                                   placeholder="cantidad de producto">
                            <input type="submit" class=" btn btn-primary" value="Descargar"/>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="m-2">
            <div class="card">
                <div class="col m-1">
                    <form action="{{ route('less_quantity')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <label>Reportes de productos </label>
                        <br/>
                        <input id="cantidad" name="cantidad" type="number">
                        <br/>

                        <br/>
                        <input onchange="myFunction(this)" type="checkbox" name="mayor" id="mayor" value=1> Productos con
                        mayor cantidad unidades <br/>
                        <input onchange="myFunction(this)" type="checkbox" name="menor" id="menor" value=2> Productos con menos cantidad unidades
                        <br/>

                        <input type="submit" class=" btn btn-primary" value="Descargar"/>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <a href="{{ route('product.index') }}" class="btn btn-primary "> Atras </a>
        </div>

    </div>



@endsection
