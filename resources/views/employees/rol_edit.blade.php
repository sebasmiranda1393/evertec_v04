@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <body style="background-color:#B5D4C8;">

                    </body>
                    @can('role.edit')
                    <div class="card-header">Editar rol</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('rol.update', $rol->id) }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <textarea required id="name" name="name" cols="30" rows="1"
                                          class="form-control">{{ $rol->name}}</textarea>

                                <br>
                                <label for="name">Asignar permisos</label>
                                <select required="required" name="permisos[]" id="permisos" class="form-control chosen" id="stipulations"  multiple>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->name}}">{{ $permission->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class=" col-sm-3">
                                </div>
                                <div class=" col-sm-4">
                                    <a href="{{ route('rol.index') }}"
                                       class="btn btn-primary btn-lg"> Atras </a>
                                </div>
                                <div class="col-sm-4">
                                    <input type="submit" class=" btn btn-primary btn-lg" value="guardar"/>
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
    @else
        <div class="card">
            <div class="col m-1">
                <label>NO TIENE PERMISOS PARA ESTA FUNCION </label>
            </div>


            <div class=" col-sm-1">
                <a href="{{ URL::route('home.index') }}" class="btn btn-primary "> Atras </a>
            </div>
    @endcan
@endsection

