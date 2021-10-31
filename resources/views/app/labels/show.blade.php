@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">Labels</h1>
    @if(auth()->user())
            <a class="btn btn-primary ml-auto" href="{{route('labels.create')}}">{{__('Create label')}}</a>
    @endif
    <table class="table mt-2">
        <thead>
            <tr>
                <th>{{__('ID')}}</th>
                <th>{{__('Имя')}}</th>
                <th>{{__('Описание')}}</th>
                <th>{{__('Дата создания')}}</th>
                <th>{{__('Действия')}}</th>
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
                            {{__('delete')}}
                        </a>
                    @endcan
                    @can('update', $label)
                         <a class="btn btn-success btn-sm" href="{{route('labels.edit', $label)}}">
                                {{__('edit')}}
                         </a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection