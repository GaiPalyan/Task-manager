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
                @auth()
                <th>@lang('interface.Actions')</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
                <tr>
                    <td>{{$status->id}}</td>
                    <td>{{$status->name}}</td>
                    <td>{{$status->created_at->format('d.m.Y')}}</td>
                    @auth()
                    <td>
                        <a class="btn btn-outline-danger btn-sm"
                           data-confirm="Вы уверены?" data-method="delete" rel="nofollow" href="{{ route('task_statuses.destroy', $status) }}">
                            @lang('interface.Delete')
                        </a>
                        <a class="btn btn-outline-success btn-sm" href="{{ route('task_statuses.edit', $status) }}">
                            @lang('interface.Edit')
                        </a>
                    </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $statuses->links() }}
@endsection