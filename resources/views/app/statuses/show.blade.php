@extends('layouts.app')
@section('content')
    <h1 class="mb-5">@lang('interface.Status')</h1>
    @auth()
    <a class="btn btn-primary" href="{{route('task_statuses.create')}}">@lang('interface.Create status')</a>
    @endauth
    <table class="table mt-2">
        <thead>
            <tr>
                <th>@lang('ID')</th>
                <th>@lang('interface.Name')</th>
                <th>@lang('interface.Created at')</th>
                <th>@lang('interface.Actions')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
                <tr>
                    <td>{{$status->id}}</td>
                    <td>{{$status->name}}</td>
                    <td>{{$status->created_at}}</td>
                    <td>
                            @can('delete', $status)
                                <a class="btn btn-danger btn-sm ml-2"
                                data-confirm="Вы уверены?" data-method="delete" rel="nofollow" href="{{ route('task_statuses.destroy', $status) }}">
                                    @lang('interface.Delete')
                                </a>
                            @endcan
                            @can('update', $status)
                                <a class="btn btn-success btn-sm float-left" href="{{ route('task_statuses.edit', $status) }}">
                                    @lang('interface.Edit')
                                </a>
                            @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $statuses->links() }}
@endsection