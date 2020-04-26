@extends('layouts.app')

@section('openUsers') open @endsection

@section('createUsers') active @endsection

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="active">Crear usuario</li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Creación de Usuarios</div>
            <div class="panel-body">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Usuario') }}</label>

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
                        <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required >

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required >

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="permissions" class="col-md-4 col-form-label">{{ __('Roles') }}</label>

                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                @foreach($roles as $role)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                                            {{ $role->name }}
                                            <em>({{ $role->description }})</em>
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
