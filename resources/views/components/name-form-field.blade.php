<input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
           name="name" {{$attributes->merge(['value' => old('name')])}} autocomplete="name" autofocus>

@error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
