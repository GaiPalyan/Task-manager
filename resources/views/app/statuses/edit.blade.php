@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">{{ __('Update status') }}</h1>
    <x-form.form method="patch" class="w-50" action="{{ route('status_update', $status) }}">
        <x-status-form-fields />
        <x-form.button class="btn-primary">
            {{ __('Update') }}
        </x-form.button>
    </x-form.form>
@endsection
