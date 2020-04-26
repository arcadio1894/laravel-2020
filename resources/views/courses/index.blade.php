@extends('layouts.app')

@section('openCourses') open @endsection

@section('indexCourses') active @endsection

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="active">Listado de cursos</li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de cursos
                <button class="btn btn-mini btn-primary pull-right">Nuevo curso</button>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Curso</th>
                            <th>Descripción</th>
                            <th colspan="3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $courses as $course )
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->description }}</td>
                            <td>
                                @can('courses.show')
                                <button data-visualizar="{{ $course->id }}" data-description="{{ $course->description }}" data-name="{{ $course->name }}" class="btn btn-sm btn-dark" title="Visualizar"><i class="ace-icon fa fa-eye"></i></button>
                                @endcan

                                @can('courses.edit')
                                <button data-edit="{{ $course->id }}" data-description="{{ $course->description }}" data-name="{{ $course->name }}" class="btn btn-sm btn-warning" title="Editar"><i class="ace-icon fa fa-pencil"></i></button>
                                @endcan

                                @can('courses.destroy')
                                <button data-destroy="{{ $course->id }}" data-name="{{ $course->name }}" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="ace-icon fa fa-trash"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $courses->links() }}
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
                <p id="showDescription"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h4 class="modal-title" id="exampleModalLabel">Eliminar curso</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formDelete" data-url="{{ url('courses/') }}" >
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body" id="bodyDelete">
                    <input type="hidden" name="id" id="courseDelete">
                    <h4>¿Esta seguro de eliminar el siguiente curso?</h4>
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
@endsection

@section('scripts')
    <script src="{{ asset('js/course/index.js') }}"></script>
@endsection
