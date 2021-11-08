@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">@lang('interface.Labels')</h1>
    @auth
        <a class="btn btn-primary ml-auto" href="{{route('labels.create')}}">@lang('interface.Create label')</a>
    @endauth
    <table class="table mt-2">
        <thead>
            <tr>
                <th>@lang('ID')</th>
                <th>@lang('interface.Name')</th>
                <th>@lang('interface.Description')</th>
                <th>@lang('interface.Created at')</th>
                <th>@lang('interface.Actions')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($labels as $label)
            <tr>
                <td>{{$label->id}}</td>
                <td>{{$label->name}}</td>
                <td>{{$label->description}}</td>
                <td>{{$label->created_at}}</td>
                <td>
                    @can('delete', $label)
                        <a class="btn btn-danger btn-sm"
                           data-confirm="Вы уверены?" data-method="delete" rel="nofollow" href="{{route('labels.destroy', $label)}}">
                            @lang('interface.Delete')
                        </a>
                    @endcan
                    @can('update', $label)
                         <a class="btn btn-success btn-sm" href="{{route('labels.edit', $label)}}">
                             @lang('interface.Edit')
                         </a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection