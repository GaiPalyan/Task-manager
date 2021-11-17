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
            <p>@lang('interface.Status'): {{head($taskStatus)}}</p>
            <p>@lang('interface.Description'): {{$task->description}}</p>
            <p>@lang('interface.Labels'):</p>
                <ul>
                    @foreach($taskLabels as $label)
                        <li>{{$label}}</li>
                    @endforeach
                </ul>
@endsection