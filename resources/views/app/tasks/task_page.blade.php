@extends('layouts.app')
@include('flash::message')
@section('content')
    <h1 class="mb-5">
            {{__('Просмотр задачи:')}} {{$task->name}}
            <a  href="{{route('tasks.edit', $task)}}">
                <x-img.edit-button />
            </a>
    </h1>
            <p>{{__('Имя:')}} {{$task->name}}</p>
            <p>{{__('Статус:')}} {{$status->name}}</p>
            <p>{{__('Описание:')}} {{$task->description}}</p>
@endsection