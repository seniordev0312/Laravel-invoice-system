<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('navbar')
        <div class="container">
            @yield('content')
        </div>

        <!-- Include JavaScript files -->
        @yield('scripts')
    </body>
</html>
