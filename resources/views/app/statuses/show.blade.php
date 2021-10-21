@extends('layouts.app')
@section('content')
    <h1 class="mb-5">Statuses</h1>
    @if(Auth::check())
    <a class="btn btn-primary" href="{{route('statuses.create')}}">{{ __('Create Status') }}</a>
    @endif
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
                        @if(Auth::check())
                        <a class="btn btn-danger btn-sm"
                           data-confirm="Вы уверены?" data-method="delete" rel="nofollow" href="{{ route('statuses.destroy', $status) }}">
                            {{__('delete')}}
                        </a>
                        <a class="btn btn-success btn-sm" href="{{ route('statuses.edit', $status) }}">
                            {{__('edit')}}
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $statuses->links() }}
@endsection