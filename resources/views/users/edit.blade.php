@extends('layouts.app')

@section('openRoles') open @endsection

@section('indexRoles') active @endsection

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="active">Editar Role</li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Edición de Usuarios</div>
            <div class="panel-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Usuario') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" name="name" required autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="roles" class="col-md-4 col-form-label">{{ __('Roles') }}</label>

                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                @foreach($roles as $role)
                                    @if (in_array($role->id, $array_roles))
                                        <li>
                                            <label>
                                                <input type="checkbox" name="roles[]" checked value="{{ $role->id }}">
                                                {{ $role->name }}
                                                <em>({{ $role->description }})</em>
                                            </label>
                                        </li>
                                    @else
                                        <li>
                                            <label>
                                                <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                                                {{ $role->name }}
                                                <em>({{ $role->description }})</em>
                                            </label>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <div class="col-md-4 col-md-offset-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Guardar cambios') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
