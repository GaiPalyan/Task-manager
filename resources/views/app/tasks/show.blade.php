@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">Tasks</h1>
    @if(auth()->user())
        <div class="d-flex">
            <a class="btn btn-primary ml-auto" href="{{route('tasks.create')}}">{{__('Create task')}}</a>
        </div>
    @endif
    <table class="table mt-2">
        <thead>
            <tr>
                <th>{{__('ID')}}</th>
                <th>{{__('Статус')}}</th>
                <th>{{__('Имя')}}</th>
                <th>{{__('Автор')}}</th>
                <th>{{__('Исполнитель')}}</th>
                <th>{{__('Дата создания')}}</th>
                <th>{{__('Действия')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{$task->status_name}}</td>
                    <td><a href="{{route('tasks.show', $task)}}">{{$task->name}}</a></td>
                    <td>{{$task->creator_name}}</td>
                    <td>{{$task->assignet_to}}</td>
                    <td>{{$task->created_at}}</td>
                    <td>
                        @can('update', $task)
                            @can('delete', $task)
                            <a class="btn btn-danger btn-sm ml-2"
                               data-confirm="Вы уверены?" data-method="delete" rel="nofollow" href="{{ route('tasks.destroy', $task) }}">
                                {{__('delete')}}
                            </a>
                            @endcan
                            <a class="btn btn-success btn-sm float-left" href="{{ route('tasks.edit', $task) }}">
                                {{__('edit')}}
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tasks->links() }}
@endsection