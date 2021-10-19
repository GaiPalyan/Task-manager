<form method="post" {{ $attributes }}>
    @isset($method)
        @if($method !== 'post')
            @method( (string) $method)
        @endif
    @endisset
        @csrf
    {{ $slot }}
</form>