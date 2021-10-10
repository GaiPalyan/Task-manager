@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registration</div>
                    <div class="card-body">
                        {{Form::open(['route' => 'register_store',])}}
                        <div class="form-group row">
                            {{Form::label('name', 'Name', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6">
                                {{Form::text('name', $value = null, $attributes = ['id' => 'name', 'class' => 'form-control',
                                            'autocomplete' => "name"])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{Form::label('email', 'Email', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6">
                                {{Form::email('email', $value = null, $attributes = ['id' => 'email', 'class' => 'form-control',
                                            'autocomplete' => "email"])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{Form::label('password', 'Password', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6">
                                {{Form::password('password',
                                       $attributes = ['id' => 'password', 'class' => 'form-control', 'autocomplete' => 'new-password'])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{Form::label('password-confirm', 'Password confirm',
                                    ['class' => 'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6">
                                {{Form::password('password_confirmation',
                                  $attributes = ['id' => 'password', 'class' => 'form-control','autocomplete' => 'new-password'])}}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{form::submit('Sign up', ['class' => 'btn btn-primary'])}}
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection