@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">{{ __('Create label') }}</h1>
    <x-form.form class="w-50" action="{{ route('labels.store') }}">
        <x-form.form-item>
            <label for="name">{{__('Name')}}</label>
            <x-name-form-field />
        </x-form.form-item>
        <x-form.form-item>
            <label for="description">
                {{__('Описание')}}
            </label>
            <textarea class="form-control" name="description" cols="50" rows="10" id="description">

            </textarea>
        </x-form.form-item>
        <x-form.submit value="Create"/>
    </x-form.form>
@endsection
