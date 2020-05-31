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

@section('styles')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/select2.min.css') }}" />
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de cursos

                    <a href="{{ route('exports.coursesPDF') }}" target="_blank" class="btn btn-mini btn-success pull-right" >Exportar cursos</a>
                @can('courses.create')
                    <button class="btn btn-mini btn-primary pull-right" id="btnCreate"> Nuevo curso</button>
                @endcan
            </div>
            <div class="panel-body">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Curso</th>
                            <th>Modificado</th>
                            <th>Descripción</th>
                            <th colspan="3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $courses as $course )
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->update_humans }}</td>
                            <td>{{ $course->description }}</td>
                            <td>
                                @can('courses.show')
                                <button data-visualizar="{{ $course->id }}" data-description="{{ $course->description }}" data-name="{{ $course->name }}" class="btn btn-sm btn-dark" title="Visualizar"><i class="ace-icon fa fa-eye"></i></button>
                                @endcan

                                @can('courses.edit')
                                <button data-edit="{{ $course->id }}" class="btn btn-sm btn-warning" title="Editar"><i class="ace-icon fa fa-pencil"></i></button>
                                @endcan

                                @can('courses.destroy')
                                <button data-destroy="{{ $course->id }}" data-name="{{ $course->name }}" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="ace-icon fa fa-trash"></i>
                                </button>
                                @endcan

                                @can('courses.assign')
                                    <button data-assign="{{ $course->id }}" data-name="{{ $course->name }}" class="btn btn-sm btn-success" title="Asignar profesores">
                                        <i class="fa fa-users"></i>
                                    </button>
                                @endcan

                                @can('courses.create')
                                        <a href="{{ route('exports.coursePDF', $course->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i></a>
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

<div class="modal fade" id="modalAssign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h4 class="modal-title" id="assignTitle"> </h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formAssign" data-url="{{ url('courses/assign/') }}" >
                @csrf
                <div class="modal-body" id="bodyAssign">
                    <input type="hidden" name="id" id="courseAssign">
                    <div class="form-group row">
                        <label for="teacher" class="col-md-4 col-form-label align-right">{{ __('Profesor Typeahead.js') }}</label>

                        <div class="col-md-8">
                            <input id="teacher" type="text" class="form-control" name="teacher">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="teachers" class="col-md-4 col-form-label align-right">{{ __('Profesores Select2') }}</label>

                        <div class="col-md-8">
                            <select multiple="" id="teachers" name="teachers[]" class="select2" data-placeholder="Click to Choose...">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Guardar cambios</button>
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

<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h4 class="modal-title" id="exampleModalLabel">Crear curso</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formCreate" data-url="{{ url('courses/store') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label align-right">{{ __('Curso') }}</label>

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
                        <label for="price" class="col-md-4 col-form-label align-right">{{ __('Precio') }}</label>

                        <div class="col-md-6">
                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stars" class="col-md-4 col-form-label align-right">{{ __('Calificación') }}</label>

                        <div class="col-md-6">
                            <input id="stars" type="number" class="form-control @error('stars') is-invalid @enderror" name="stars" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hours" class="col-md-4 col-form-label align-right">{{ __('Horario') }}</label>

                        <div class="col-md-6">
                            <textarea id="hours" class="form-control" name="hours" ></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="active" class="col-md-4 col-form-label align-right">{{ __('Estado') }}</label>

                        <div class="col-md-6">
                            <input type="radio" name="active" value="1" > Activado
                            <input type="radio" name="active" value="0" checked> Desactivado
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
                    <h4 class="modal-title" id="exampleModalLabel">Editar curso</h4>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form method="POST" id="formEdit" data-url="{{ url('courses/update') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body" id="bodyEdit">
                    <input type="hidden" name="id">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label align-right">{{ __('Curso') }}</label>

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
                        <label for="price" class="col-md-4 col-form-label align-right">{{ __('Precio') }}</label>

                        <div class="col-md-6">
                            <input id="price" type="number" class="form-control" name="price" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stars" class="col-md-4 col-form-label align-right">{{ __('Calificación') }}</label>

                        <div class="col-md-6">
                            <input id="stars" type="number" class="form-control @error('stars') is-invalid @enderror" name="stars" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hours" class="col-md-4 col-form-label align-right">{{ __('Horario') }}</label>

                        <div class="col-md-6">
                            <textarea id="hours" class="form-control" name="hours" ></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="active" class="col-md-4 col-form-label align-right">{{ __('Estado') }}</label>

                        <div class="col-md-6">
                            <input type="radio" id="radio_active" name="active" value="1" > Activado
                            <input type="radio" id="radio_inactive" name="active" value="0" > Desactivado
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
    <script src="{{ asset('js/course/index.js') }}"></script>
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
