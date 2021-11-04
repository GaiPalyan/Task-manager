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
            <p>{{__('Статус:')}} {{data_get($taskData, 'taskStatus.name')}}</p>
            <p>{{__('Описание:')}} {{$task->description}}</p>
            <p>{{_('Метки:')}}</p>
                <ul>
                    @foreach(data_get($taskData, 'taskLabels') as $label)
                        <li>{{$label->name}}</li>
                    @endforeach
                </ul>
@endsection