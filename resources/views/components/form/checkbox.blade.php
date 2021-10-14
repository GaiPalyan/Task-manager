<div class="form-check">
    <input class="form-check-input" type="checkbox"
           name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

    <label class="form-check-label" for="remember">
        {{ $slot }}
    </label>
</div>
