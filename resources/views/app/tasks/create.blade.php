@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">{{ __('Create task') }}</h1>
    <x-form.form class="w-50" action="{{ route('tasks.store') }}">
        <x-form.form-item>
            <label for="name">{{__('Имя')}}</label>
            <x-name-form-field />
        </x-form.form-item>

        <x-form.form-item>
            <label for="description">{{__('Описание')}}</label>
                <textarea class="form-control" name="description" cols="50" rows="10" id="description"></textarea>
        </x-form.form-item>

        <x-form.form-item>
            <label for="status_id">{{__('Статус')}}</label>
                <select class="form-control @error('status_id') is-invalid @enderror" id="status_id" name="status_id">
                    <option selected="selected" value="">----------</option>
                    @foreach($statuses as $status)
                        <option value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                </select>
                @error('status_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </x-form.form-item>

        <x-form.form-item>
            <label for="assigned_to_id">{{__('Исполнитель')}}</label>
                <select class="form-control" id="assigned_to_id" name="assigned_to_id">
                    <option selected="selected" value="">----------</option>
                </select>
        </x-form.form-item>

        <x-form.form-item>
            <label for="assigned_to_id">{{__('Метки')}}</label>
                <select class="form-control" multiple="" name="labels[]">
                    <option value=""></option>
                </select>
        </x-form.form-item>

        <x-form.submit value="Create" />
    </x-form.form>
@endsection
