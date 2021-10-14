@extends('layouts.app')
@section('content')
    <h1 class="mb-5">Statuses</h1>
    @if(Auth::check())
    <a class="btn btn-primary" href="{{route('status_create')}}">{{ __('Create status') }}</a>
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
                        <a class="text-danger" href="">{{__('delete')}}</a>
                        <a href="{{ route('status_edit', $status) }}">{{__('edit')}}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $statuses->links() }}
@endsection