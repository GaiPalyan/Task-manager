@extends('layouts.app')
@section('content')
    @include('flash::message')
    <h1 class="mb-5">Tasks</h1>
    <div class="d-flex">
        <a class="btn btn-primary ml-auto" href="{{route('tasks.create')}}">{{__('Create task')}}</a>
    </div>

    <table class="table mt-2">
        <thead>
            <tr>
                <th>{{__('ID')}}</th>
                <th>{{__('Статус')}}</th>
                <th>{{__('Имя')}}</th>
                <th>{{__('Автор')}}</th>
                <th>{{__('Исполнитель')}}</th>
                <th>{{__('Дата создания')}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
@endsection