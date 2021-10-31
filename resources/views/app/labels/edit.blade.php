@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">{{ __('Изменение метки') }}</h1>
    <x-form.form method="PATCH" class="w-50" action="{{ route('labels.update', $label) }}">
        <x-form.form-item>
            <label for="name">{{__('Name')}}</label>
            <x-name-form-field value="{{$label->name}}"/>
        </x-form.form-item>
        <x-form.form-item>
            <label for="description">
                {{__('Описание')}}
            </label>
            <textarea class="form-control"
                      name="description" cols="50" rows="10"
                      id="description">{{$label->description}}</textarea>
        </x-form.form-item>
        <x-form.submit value="Update"/>
    </x-form.form>
@endsection
