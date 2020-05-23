@extends('layouts.app')

@section('openTeachers') open @endsection

@section('indexTeachers') active @endsection

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="active">Listado de profesores</li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de profesores
                <button class="btn btn-mini btn-primary pull-right" id="btnCreate"> Nuevo profesor</button>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profesor</th>
                            <th>Especialidad</th>
                            <th>Tiempo de experiencia</th>
                            <th>País de origen</th>
                            <th>Teléfono</th>
                            <th colspan="3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $teachers as $teacher )
                        <tr>
                            <td>{{ $teacher->id }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->speciality }}</td>
                            <td>{{ $teacher->years }}</td>
                            <td>{{ $teacher->country }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>
                                @can('teachers.show')
                                <button data-visualizar="{{ $teacher->id }}" class="btn btn-sm btn-dark" title="Visualizar"><i class="ace-icon fa fa-eye"></i></button>
                                @endcan

                                @can('teachers.edit')
                                <button data-edit="{{ $teacher->id }}" class="btn btn-sm btn-warning" title="Editar"><i class="ace-icon fa fa-pencil"></i></button>
                                @endcan

                                @can('teachers.destroy')
                                <button data-destroy="{{ $teacher->id }}" data-name="{{ $teacher->name }}" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="ace-icon fa fa-trash"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h4 class="modal-title" id="exampleModalLabel">Ver Profesor</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form id="formShow">
                @csrf
                <div class="modal-body" id="bodyShow">
                    <input type="hidden" name="id">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label align-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="speciality" class="col-md-4 col-form-label align-right">{{ __('Especialidad') }}</label>

                        <div class="col-md-6">
                            <input id="speciality" type="text" class="form-control" name="speciality" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="years" class="col-md-4 col-form-label align-right">{{ __('Tiempo de experiencia') }}</label>

                        <div class="col-md-6">
                            <input id="years" type="number" class="form-control" name="years" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="country" class="col-md-4 col-form-label align-right">{{ __('País de origen') }}</label>

                        <div class="col-md-6">
                            <input id="country" type="text" class="form-control" name="country" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label align-right">{{ __('Teléfono') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label align-right">{{ __('Imagen') }}</label>

                        <div class="col-md-6">
                            <img id="image_preview2" src="" width="100px" height="100px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer align-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h4 class="modal-title" id="exampleModalLabel">Eliminar Profesor</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formDelete" data-url="{{ url('teachers/') }}" >
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body" id="bodyDelete">
                    <input type="hidden" name="id" id="teacherDelete">
                    <h4>¿Esta seguro de eliminar el Profesor?</h4>
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
                    <h4 class="modal-title" id="exampleModalLabel">Crear profesor</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formCreate" data-url="{{ url('teachers/store') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label align-right">{{ __('Profesor') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label align-right">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="speciality" class="col-md-4 col-form-label align-right">{{ __('Especialidad') }}</label>

                        <div class="col-md-6">
                            <input id="speciality" type="text" class="form-control" name="speciality" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="years" class="col-md-4 col-form-label align-right">{{ __('Tiempo de experiencia') }}</label>

                        <div class="col-md-6">
                            <input id="years" type="number" class="form-control" name="years" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="country" class="col-md-4 col-form-label align-right">{{ __('País de origen') }}</label>

                        <div class="col-md-6">
                            <input id="country" type="text" class="form-control" name="country">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label align-right">{{ __('Teléfono') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label align-right">{{ __('Imagen') }}</label>

                        <div class="col-md-6">
                            <input type="file" name="image" id="image">
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
                    <h4 class="modal-title" id="exampleModalLabel">Editar Profesor</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formEdit" data-url="{{ url('teachers/update') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body" id="bodyEdit">
                    <input type="hidden" name="id">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label align-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="speciality" class="col-md-4 col-form-label align-right">{{ __('Especialidad') }}</label>

                        <div class="col-md-6">
                            <input id="speciality" type="text" class="form-control" name="speciality" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="years" class="col-md-4 col-form-label align-right">{{ __('Tiempo de experiencia') }}</label>

                        <div class="col-md-6">
                            <input id="years" type="number" class="form-control" name="years" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="country" class="col-md-4 col-form-label align-right">{{ __('País de origen') }}</label>

                        <div class="col-md-6">
                            <input id="country" type="text" class="form-control" name="country">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label align-right">{{ __('Teléfono') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label align-right">{{ __('Imagen') }}</label>

                        <div class="col-md-6">
                            <input type="file" name="image" id="image">
                            <img id="image_preview" src="" width="100px" height="100px">
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
    <script src="{{ asset('js/teacher/index.js') }}"></script>
@endsection
