@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                        <table class="table table-striped" border = "1">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Update_at</th>
                                <th scope="col">Status</th>
                                <th scope="col">Edit</th>
                            </tr>
                            </thead>
                            @foreach ($users as $user)

                                <tr>
                                    <th scope="row">{{ $user->id}}</th>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->created_at}}</td>
                                    <td>{{ $user->updated_at}}</td>
                                    <td>
                                        @if($user->status==1)
                                            Habilitado
                                        @endif
                                        @if($user->status==0)
                                                Deshabilitado
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('posts.edit', $user->id) }}" class="label label-warning">Edit</a>
                                     </td>

                                </tr>
                            @endforeach
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
