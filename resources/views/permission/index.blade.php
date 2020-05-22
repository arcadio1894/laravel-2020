@extends('layouts.app')

@section('openPermission') open @endsection

@section('indexPermission') active @endsection

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="active">Listado de Permisos</li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('styles')
    
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de Permisos
                <button class="btn btn-mini btn-primary pull-right" id="btnCreate"> Nuevo Permiso</button>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Permiso</th>
                            <th>Slug</th>
                            <th>Descripción</th>
                            <th colspan="3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $permissions as $permission )
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->slug}}</td>
                            <td>{{ $permission->description}}</td>
                            <td>
                                
                                <button data-visualizar="{{ $permission->id }}" data-slug="{{ $permission->slug }}" data-description="{{ $permission->description }}" data-name="{{ $permission->name }}" class="btn btn-sm btn-dark" title="Visualizar"><i class="ace-icon fa fa-eye"></i></button>
                                                        
                                <button data-edit="{{ $permission->id }}" class="btn btn-sm btn-warning" title="Editar"><i class="ace-icon fa fa-pencil"></i></button>
                               
                                <button data-destroy="{{ $permission->id }}" data-name="{{ $permission->name }}" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="ace-icon fa fa-trash"></i>
                                </button>
                              

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h4 class="modal-title" id="exampleModalLabel">Ver Permiso</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <div class="modal-body" id="bodyShow">

            <div class="form-group row">
                <label for="showName" class="col-md-4 col-form-label align-right">{{ __('Permiso') }}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="showName" id="showName" readonly="readonly"></input>
                </div>
            </div>

            <div class="form-group row">
                <label for="showSlug" class="col-md-4 col-form-label align-right">{{ __('Slug') }}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="showSlug" id="showSlug" readonly="readonly"></input>
                </div>
            </div>

            <div class="form-group row">
                <label for="showDescription" class="col-md-4 col-form-label align-right">{{ __('Descripción') }}</label>

                <div class="col-md-6">
                    <textarea type="text" class="form-control" name="showDescription" id="showDescription" readonly="readonly"></textarea>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h4 class="modal-title" id="exampleModalLabel">Eliminar Permiso</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formDelete" data-url="{{ url('permission/') }}" >
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body" id="bodyDelete">
                    <input type="hidden" name="id" id="permissionDelete">
                    <h4>¿Esta seguro de eliminar el siguiente Permiso?</h4>
                    <h4 id="showName"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h4 class="modal-title" id="exampleModalLabel">Crear Permiso</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formCreate" data-url="{{ url('permission/store') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">
                <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label align-right">{{ __('Permiso') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="slug" class="col-md-4 col-form-label align-right">{{ __('Slug') }}</label>

                        <div class="col-md-6">
                            <input id="slug" type="text" class="form-control" name="slug">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label align-right">{{ __('Descripción') }}</label>

                        <div class="col-md-6">
                            <textarea id="description" type="text" class="form-control" name="description" ></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer align-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Permiso</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formEdit" data-url="{{ url('permission/update') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body" id="bodyEdit">
                    <input type="hidden" name="id">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label align-right">{{ __('Permiso') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="slug" class="col-md-4 col-form-label align-right">{{ __('Slug') }}</label>

                        <div class="col-md-6">
                            <input id="slug" type="text" class="form-control" name="slug">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label align-right">{{ __('Descripción') }}</label>

                        <div class="col-md-6">
                            <textarea id="description" type="text" class="form-control" name="description" ></textarea>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer align-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/permission/index.js') }}"></script>
@endsection
