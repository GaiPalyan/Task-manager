@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Вход') }}</div>

                <div class="card-body">
                    <x-form.form action="{{ route('login') }}">

                        @include('layouts.auth')

                        <x-form.form-item class="row">
                            <div class="col-md-6 offset-md-4">
                                <x-form.checkbox>
                                    {{ __('Запомнить меня') }}
                                </x-form.checkbox>
                            </div>
                        </x-form.form-item>

                        <x-form.form-item class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-primary" type="submit">
                                    {{ __('Войти') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Забыли пароль?') }}
                                    </a>
                                @endif
                            </div>
                        </x-form.form-item>
                    </x-form.form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
