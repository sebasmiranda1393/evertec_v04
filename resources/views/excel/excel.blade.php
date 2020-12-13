<!DOCTYPE html>
<html>
<head>
    <title>Import Excel File in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<body style="background-color:#AED6F1;">

</body>
<br/>

<div class="container">
    <h3 align="center">actualizar mis productos desde excel</h3>
    <br/>

    @if(count($errors)>0)
        <div class="alert-danger">
            El campo de selección de archivo es obligatorio<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($message = Session::get('success'))
        <div class="alert success alert-block">
        <button type="button" class="close" data-dismiss="alert"
        >x
        </button>
        <strong> {{ $message }}</strong>
</div>
@endif

<form method="POST" enctype="multipart/form-data" action="{{ route('excel.store') }}">
    @csrf
    <div class="form-group">
        <table class="table">
            <tr>
                <td width="40%" align="right"><label>Seleccionar archivo para cargar</label></td>
                <td width="30">
                    <input type="file" name="select_file"/>
                </td>
                <td width="30%" align="left">
                    <input type="submit" name="upload" class="btn btn-primary" value="cargar el archivo">
                </td>
                <td width="30%" align="left">
                    <a href="{{ URL::route('product.index') }}" class="btn btn-primary "> Atras </a>
                </td>
            </tr>

        </table>
    </div>
</form>

<br/>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3  class="panel-title-center">Mis Productos</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Valor Venta</th>
                    <th scope="col">Valor Compra</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Estado</th>
                </tr>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id}}</th>
                        <td>{{ $product->name}}</td>
                        @if($product->categoria!=null)
                            <td>{{ $product->categoria->category}}</td>
                        @else
                            <td>{{ $product->category}}</td>
                        @endif
                        <td>{{ $product->description}}</td>
                        <td>{{ $product->sale_price}}</td>
                        <td>{{ $product->purchase_price}}</td>
                        <td>{{ $product->available}}</td>
                        <td>
                            @if($product->status==true)
                                Habilitado
                            @endif
                            @if($product->status==false)
                                Deshabilitado
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</div>
</body>
</html>
