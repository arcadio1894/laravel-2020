@extends('layouts.app')

@section('openRoles') open @endsection

@section('createRoles') active @endsection

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="active">Crear Role</li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Creación de Roles</div>
            <div class="panel-body">
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Rol') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="slug" class="col-md-4 col-form-label text-md-left">{{ __('Url Amigable') }}</label>

                        <div class="col-md-6">
                            <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" required >

                            @error('slug')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-left">{{ __('Descripción') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required >

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="special" class="col-md-4 col-form-label text-md-left">{{ __('Permisos especiales') }}</label>

                        <div class="col-md-6">
                            <input type="radio" id="without" checked name="special" value="without">
                            <label for="without">Sin permiso especial</label><br>
                            <input type="radio" id="all-access" name="special" value="all-access">
                            <label for="all-access">Acceso total</label><br>
                            <input type="radio" id="no-access" name="special" value="no-access">
                            <label for="no-access">Ningún acceso</label><br>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="permissions" class="col-md-4 col-form-label">{{ __('Permisos') }}</label>

                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                @foreach($permissions as $permission)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                            {{ $permission->name }}
                                            <em>({{ $permission->description }})</em>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <div class="col-md-4 col-md-offset-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Registrar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
