@extends('layouts.app')

@section('openPermissions') open @endsection

@section('indexPermissions') active @endsection

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="active">Listado de permisos</li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/select2.min.css') }}" />
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de permisos
                <button class="btn btn-mini btn-primary pull-right" id="btnCreate"> Nuevo permiso</button>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Permiso</th>
                            <th>URL Amigable</th>
                            <th>Descripción</th>
                            <th colspan="3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $permissions as $permission )
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->slug }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                @can('permissions.show')
                                <button data-visualizar="{{ $permission->id }}" data-slug="{{ $permission->slug }}" data-description="{{ $permission->description }}" data-name="{{ $permission->name }}" class="btn btn-sm btn-dark" title="Visualizar"><i class="ace-icon fa fa-eye"></i></button>
                                @endcan

                                @can('permissions.edit')
                                <button data-edit="{{ $permission->id }}" class="btn btn-sm btn-warning" title="Editar"><i class="ace-icon fa fa-pencil"></i></button>
                                @endcan

                                @can('permissions.destroy')
                                <button data-destroy="{{ $permission->id }}" data-name="{{ $permission->name }}" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="ace-icon fa fa-trash"></i>
                                </button>
                                @endcan
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
                    <h4 class="modal-title" id="exampleModalLabel">Modal title</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <div class="modal-body" id="bodyShow">
                <p id="showName"></p>
                <p id="showSlug"></p>
                <p id="showDescription"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h4 class="modal-title" id="exampleModalLabel">Eliminar permiso</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formDelete" data-url="{{ url('permissions/') }}" >
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body" id="bodyDelete">
                    <input type="hidden" name="id" id="permissionDelete">
                    <h4>¿Esta seguro de eliminar el siguiente permiso?</h4>
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
                    <h4 class="modal-title" id="exampleModalLabel">Crear permiso</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formCreate" data-url="{{ url('permissions/store') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label align-right">{{ __('Permiso') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label align-right">{{ __('Descripción') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="slug" class="col-md-4 col-form-label align-right">{{ __('URL Amigabale') }}</label>

                        <div class="col-md-6">
                            <input id="slug" type="text" class="form-control" name="slug" >
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
                    <h4 class="modal-title" id="exampleModalLabel">Editar permiso</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formEdit" data-url="{{ url('permissions/update') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body" id="bodyEdit">
                    <input type="hidden" name="id">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label align-right">{{ __('Permiso') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label align-right">{{ __('Descripción') }}</label>

                        <div class="col-md-6">
                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" ></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="slug" class="col-md-4 col-form-label align-right">{{ __('URL Amigable') }}</label>

                        <div class="col-md-6">
                            <input id="slug" type="text" class="form-control" name="slug" >
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

@endsection

@section('scripts')
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/permission/index.js') }}"></script>
    <script type="text/javascript">
        jQuery(function($){$('.select2').css('width','300px').select2({allowClear:false})
            $('#select2-multiple-style .btn').on('click', function(e){
                var target = $(this).find('input[type=radio]');
                var which = parseInt(target.val());
                if(which == 2) $('.select2').addClass('tag-input-style');
                else $('.select2').removeClass('tag-input-style');
            });
        });
    </script>
@endsection
