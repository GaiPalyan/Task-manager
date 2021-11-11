@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">@lang('interface.Update task')</h1>
    <x-form.form method="patch" class="w-50" action="{{ route('tasks.update', $task) }}">
        <x-form.form-item>
            <label for="name" >@lang('interface.Name')</label>
            <x-name-form-field value="{{$task->name}}" />
        </x-form.form-item>

        <x-form.form-item>
            <label for="description">@lang('interface.Description')</label>
            <textarea class="form-control" name="description" cols="50" rows="10" id="description"></textarea>
        </x-form.form-item>

        <x-form.form-item>
            <label for="status_id">@lang('interface.Status')</label>
            <select class="form-control @error('status_id') is-invalid @enderror" id="status_id" name="status_id">
                <option selected="selected" value="{{data_get($availableOptions, 'taskStatus.id')}}">
                    {{data_get($availableOptions, 'taskStatus.name')}}
                </option>
                    @foreach(data_get($availableOptions, 'statuses') as $status)
                        <option value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                <option value="">----------</option>
            </select>
            @error('status_id')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </x-form.form-item>

        <x-form.form-item>
            <label for="assigned_to_id">@lang('interface.Performer')</label>
            <select class="form-control" id="assigned_to_id" name="assigned_to_id">
                <option selected="selected" value="{{data_get($availableOptions, 'taskPerformer.id')}}">
                    {{data_get($availableOptions, 'taskPerformer.name', '----------')}}
                </option>
                    @foreach(data_get($availableOptions, 'performers') as $performer)
                        <option value="{{$performer->performer_id}}">{{$performer->performer_name}}</option>
                    @endforeach
                @if(data_get($availableOptions, 'taskPerformer'))
                    <option value="">----------</option>
                @endif
            </select>
        </x-form.form-item>

        <x-form.form-item>
            <label for="labels">@lang('interface.Labels')</label>
            <select class="form-control" multiple="" name="labels[]">
                @foreach(data_get($availableOptions, 'labels') as $label)
                <option value="{{$label->id}}">{{$label->name}}</option>
                @endforeach
            </select>
        </x-form.form-item>

        <x-form.submit value="{{__('interface.Update btn')}}" />
    </x-form.form>
@endsection