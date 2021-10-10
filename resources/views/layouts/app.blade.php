<!doctype html>
<html lang="{{str_replace('-', '_', app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Task manager')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <div class="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">Task manager</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Statuses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Labels</a>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">Log-In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('register_index')}}">Sign up</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
