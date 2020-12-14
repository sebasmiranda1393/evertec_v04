@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <body style="background-color:#AED6F1;">

                </body>
                <div class="card">
                    <div class="col m-1">
                        <label>NO TIENE PERMISOS PARA ESTA FUNCION </label>
                    </div>


                    <div class=" col-sm-1">
                        <a href="{{ route('home.index') }}" class="btn btn-primary "> Atras </a>
                    </div>
            </div>
        </div>
    </div>
@endsection
