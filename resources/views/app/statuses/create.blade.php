@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">{{ __('Create Status') }}</h1>
        <x-form.form class="w-50" action="{{ route('statuses.store') }}">
            <label for="name">{{__('Name')}}</label>
            <x-form.form-item>
                <x-name-form-field />
            </x-form.form-item>
                <x-form.submit value="Create"/>
        </x-form.form>
@endsection
