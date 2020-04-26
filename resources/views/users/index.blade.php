@extends('layouts.app')

@section('openUsers') open @endsection

@section('indexUsers') active @endsection

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="active">Listado de usuarios</li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de usuarios</div>
            <div class="panel-body">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th colspan="3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $users as $user )
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @can('users.show')
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-dark" title="Visualizar"><i class="ace-icon fa fa-eye"></i></a>
                                @endcan

                                @can('users.edit')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="ace-icon fa fa-pencil"></i></a>
                                @endcan

                                @can('users.destroy')
                                <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-sm btn-danger" title="Eliminar"
                                   onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">
                                    <i class="ace-icon fa fa-trash"></i>
                                </a>

                                <form id="delete-form" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
