<x-form.form-item>
    <label for="name">{{__('Name')}}</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

    @error('name')
    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
    @enderror
</x-form.form-item>