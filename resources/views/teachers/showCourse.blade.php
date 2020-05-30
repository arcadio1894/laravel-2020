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
            <li class="active">Listado de cursos programados</li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de Cursos
            </div>
            <div class="panel-body">
                @if( isset($courses)  )
                <div>
                    <strong>Docente</strong><h4>{{ $courses[0]->name }}</h4>
                    <strong>Especialidad</strong><h4>{{ $courses[0]->speciality }}</h4>
                </div>
                @else
                    <strong>Usted no es docente de algun curso</strong>
                @endif
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Curso Asignado</th>
                            <th>Horario</th>
                            <th colspan="3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($courses))
                        @foreach( $courses[0]->courses as $course )
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->hours }}</td>
                            <td>
                                @can('teacher.showtasks')
                                    <a href="{{ route('courses.subjects', $course->id) }}" class="btn btn-sm btn-success">Administrar temas</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td> No tien cursos asignados </td>
                        </tr>
                    @endif
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
