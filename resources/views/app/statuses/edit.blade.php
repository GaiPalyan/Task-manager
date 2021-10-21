@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">{{ __('Update Status') }}</h1>
    <x-form.form method="patch" class="w-50" action="{{ route('statuses.update', $status) }}">

        <x-form.form-item>
            <x-name-form-field />
        </x-form.form-item>

        <x-form.submit value="Update"/>

    </x-form.form>
@endsection
