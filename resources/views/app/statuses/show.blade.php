@extends('layouts.app')
@section('content')
    <h1 class="mb-5">{{__('Статусы')}}</h1>
    @auth()
    <a class="btn btn-primary" href="{{route('statuses.create')}}">{{ __('Create status') }}</a>
    @endauth
    <table class="table mt-2">
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Created date') }}</th>
                <th>{{ __('action') }}</th>
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
                                data-confirm="Вы уверены?" data-method="delete" rel="nofollow" href="{{ route('statuses.destroy', $status) }}">
                                    {{__('delete')}}
                                </a>
                            @endcan
                            @can('update', $status)
                                <a class="btn btn-success btn-sm float-left" href="{{ route('statuses.edit', $status) }}">
                                    {{__('edit')}}
                                </a>
                            @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $statuses->links() }}
@endsection