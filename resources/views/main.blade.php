<!DOCTYPE html>
<html>
    <head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    
    </head>
    <body>
        @include('panel')
        <div class="container">
            @yield('content')
        </div>

        <!-- Include JavaScript files -->
        @yield('scripts')
    </body>
</html>
