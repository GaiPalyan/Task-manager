@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">@lang('interface.Tasks')</h1>
        <div class="d-flex">
            <div>
                <form method="GET" class="form-inline" accept-charset="UTF-8" action={{route('tasks.index')}}>
                    <select class="form-control mr-2" name="filter[status_id]">
                            <option selected="selected" value="">@lang('interface.Status')</option>
                        @foreach(data_get($availableOptions, 'statuses') as $status)
                            <option value="{{$status->id}}">{{$status->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control mr-2" name="filter[created_by_id]">
                            <option selected="selected" value="">@lang('interface.Author')</option>
                        @foreach(data_get($availableOptions, 'creators') as $task)
                            <option value="{{$task->creator_id}}">{{$task->creator_name}}</option>
                        @endforeach
                    </select>

                    <select class="form-control mr-2" name="filter[assigned_to_id]">
                        <option selected="selected" value="">@lang('interface.Performer')</option>
                        @foreach(data_get($availableOptions, 'performers') as $task)
                            <option value="{{$task->performer_id}}">{{$task->performer_name}}</option>
                        @endforeach
                    </select>

                    <input class="btn btn-outline-primary mr-2" type="submit" value="Применить">
                </form>
            </div>
            @auth
            <a class="btn btn-primary ml-auto" href="{{route('tasks.create')}}">@lang('interface.Create task')</a>
            @endauth
        </div>
    <table class="table mt-2">
        <thead>
            <tr>
                <th>@lang('ID')</th>
                <th>@lang('interface.Status')</th>
                <th>@lang('interface.Name')</th>
                <th>@lang('interface.Author')</th>
                <th>@lang('interface.Performer')</th>
                <th>@lang('interface.Created at')</th>
                @auth()
                <th>@lang('interface.Actions')</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($tasksList as $task)
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{optional($task->status)->name}}</td>
                    <td><a href="{{route('tasks.show', $task)}}">{{$task->name}}</a></td>
                    <td>{{optional($task->creator)->name}}</td>
                    <td>{{optional($task->performer)->name}}</td>
                    <td>{{$task->created_at->format('d.m.Y')}}</td>
                    <td>
                        @can('update', $task)
                            @can('delete', $task)
                            <a class="btn btn-outline-danger btn-sm"
                               data-confirm="Вы уверены?" data-method="delete" rel="nofollow" href="{{ route('tasks.destroy', $task) }}">
                                @lang('interface.Delete')
                            </a>
                            @endcan
                            <a class="btn btn-outline-success btn-sm" href="{{ route('tasks.edit', $task) }}">
                                @lang('interface.Edit')
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tasksList->links() }}
@endsection