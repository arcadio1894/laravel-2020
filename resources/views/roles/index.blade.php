@extends('layouts.app')

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="active">Listado de roles</li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de roles</div>
            <div class="panel-body">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Rol</th>
                            <th>Url Amigable</th>
                            <th>Descripción</th>
                            <th>Permiso Especial</th>
                            <th colspan="3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $roles as $role )
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->slug }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                @switch($role->special)
                                    @case('all-access')
                                        {{ 'Acceso Total' }}
                                    @break

                                    @case('no-access')
                                        {{ 'Ningún acceso ' }}
                                    @break

                                    @default
                                        {{ 'Ninguno' }}
                                @endswitch
                            </td>
                            <td>
                                @can('roles.show')
                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-dark" title="Visualizar"><i class="ace-icon fa fa-eye"></i></a>
                                @endcan

                                @can('roles.edit')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="ace-icon fa fa-pencil"></i></a>
                                @endcan

                                @can('roles.destroy')
                                <a href="{{ route('roles.destroy', $role->id) }}" class="btn btn-sm btn-danger" title="Eliminar"
                                   onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">
                                    <i class="ace-icon fa fa-trash"></i>
                                </a>

                                <form id="delete-form" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
