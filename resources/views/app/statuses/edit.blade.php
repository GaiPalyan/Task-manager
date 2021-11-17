@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">@lang('interface.Update status')</h1>
    <x-form.form method="patch" class="w-50" action="{{ route('task_statuses.update', $status) }}">

        <x-form.form-item>
            <x-name-form-field value="{{$status->name}}"/>
        </x-form.form-item>

        <x-form.submit value="{{__('interface.Update btn')}}"/>

    </x-form.form>
@endsection
