@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">@lang('interface.Create status'):</h1>
        <x-form.form class="w-50" action="{{ route('task_statuses.store') }}">
            <label for="name">@lang('interface.Name')*</label>
            <x-form.form-item>
                <x-name-form-field />
            </x-form.form-item>
                <x-form.submit value="{{__('interface.Create')}}"/>
        </x-form.form>
@endsection
