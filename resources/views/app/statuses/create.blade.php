@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">{{ __('Create status') }}</h1>
        <x-form.form class="w-50" action="{{ route('status_store') }}">
            <x-status-form-fields />
                <x-form.button class="btn-primary">
                    {{ __('Create') }}
                </x-form.button>
        </x-form.form>
@endsection
