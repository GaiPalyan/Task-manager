<form method="post" {{ $attributes }}>
    @isset($method)
            @method( (string) $method)
    @endisset
        @csrf
    {{ $slot }}
</form>