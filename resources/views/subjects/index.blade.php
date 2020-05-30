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


@endsection

@section('scripts')
    {{--<script src="{{ asset('js/teacher/index.js') }}"></script>--}}
@endsection
