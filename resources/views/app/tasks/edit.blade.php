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
                <option value="">{{__('-----------')}}</option>
                @foreach($statuses as $id => $name)
                    @if($id === $task->status_id)
                        <option selected="selected" value="{{$task->status_id}}">
                            {{$name}}
                        </option>
                    @else
                        <option value="{{$id}}">
                            {{$name}}
                        </option>
                    @endif
                @endforeach
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
                <option value="">{{__('-----------')}}</option>

                    @foreach($performers as $id => $name)
                        @if($id === $task->assigned_to_id)
                                <x-default-selected-option value="{{$task->assigned_to_id}}">
                                    {{$name}}
                                </x-default-selected-option>
                        @else
                            <option value="{{$id}}">
                                {{$name}}
                            </option>
                        @endif
                    @endforeach

            </select>
        </x-form.form-item>


        <x-form.form-item>
            <label for="labels">@lang('interface.Labels')</label>
            <select class="form-control" multiple="" name="labels[]">
                <option value=""></option>
                @foreach($labels as $id => $name)
                        @if(array_key_exists($id, $taskLabels))
                                <x-default-selected-option value="{{$id}}">
                                    {{$name}}
                                </x-default-selected-option>
                        @else
                            <option value="{{$id}}">
                                {{$name}}
                            </option>
                        @endif
                @endforeach
            </select>
        </x-form.form-item>


        <x-form.submit value="{{__('interface.Update btn')}}" />
    </x-form.form>
@endsection