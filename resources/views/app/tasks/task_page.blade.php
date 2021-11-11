@extends('layouts.app')
@include('flash::message')
@section('content')
    <h1 class="mb-5">
        @lang('interface.Task page'): {{$task->name}}
            <a  href="{{route('tasks.edit', $task)}}">
                <x-img.edit-button />
            </a>
    </h1>
            <p>@lang('interface.Name'): {{$task->name}}</p>
            <p>@lang('interface.Status'): {{data_get($taskData, 'taskStatus')->name}}</p>
            <p>@lang('interface.Description'): {{$task->description}}</p>
        @isset($taskData['taskLabels'])
            <p>@lang('interface.Labels'):</p>
                <ul>
                    @foreach(data_get($taskData, 'taskLabels') as $label)
                        <li>{{$label->name}}</li>
                    @endforeach
                </ul>
        @endisset
@endsection