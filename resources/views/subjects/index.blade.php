@extends('layouts.app')

@section('openShowCourse') open @endsection

@section('indexShowCourse') active @endsection

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('teachers.showCourse') }}">Cursos programados</a>
            </li>
            <li class="active">Curso {{ $course->name }}</li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de temas del curso {{ $course->name }}
                @can('teacher.showcontent')
                    <button class="btn btn-mini btn-primary pull-right" id="btnCreate"> Nuevo tema</button>
                @endcan
            </div>
            <div class="panel-body">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tema</th>
                            <th>Horario</th>
                            <th colspan="3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $course->subjects as $subject )
                        <tr>
                            <td>{{ $subject->id }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->description }}</td>
                            <td>
                                @can('teacher.showcontent')
                                    <a href="{{ route('subject.contents', $subject->id) }}" class="btn btn-sm btn-success">Administrar contenidos</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h4 class="modal-title" id="exampleModalLabel">Crear Tema</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formCreate" data-url="{{ url('subjects/store') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label align-right">{{ __('Tema') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label align-right">{{ __('Descripción') }}</label>

                        <div class="col-md-6">
                            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
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



@endsection

@section('scripts')
    <script src="{{ asset('js/subject/index.js') }}"></script>
@endsection
