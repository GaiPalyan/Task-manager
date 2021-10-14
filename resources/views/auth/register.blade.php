@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card>
                <x-card-header>
                    {{ __('Register') }}
                </x-card-header>

                <x-card-body>
                    <x-form.form action="{{ route('register') }}">
                        @csrf

                        <x-form.form-item class="row">
                            <x-form.label for="name">
                                {{ __('Name') }}
                            </x-form.label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </x-form.form-item>

                        @include('layouts.auth')

                        <x-form.form-item class="row">
                            <x-form.label for="password-confirm">{{ __('Confirm Password') }}</x-form.label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </x-form.form-item>
                        <x-form.form-item class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <x-form.button class="btn-primary">{{ __('Sign Up') }}</x-form.button>
                            </div>
                        </x-form.form-item>
                    </x-form.form>
                </x-card-body>
            </x-card>
        </div>
    </div>
</div>
@endsection
