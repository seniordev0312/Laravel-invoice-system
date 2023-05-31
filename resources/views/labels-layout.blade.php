<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link href="{{ asset('css/panel.css')}}" rel="stylesheet" >
        <link  href="{{ asset('css/app2.css') }}" rel="stylesheet">
        <link  href="{{ asset('css/label.css') }}" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        @include('labels-navbar')
        <div class="content">
            @yield('content')
        </div>

        <!-- To toggle the visibility of the content when the button is clicked -->
        <script>
            $(document).ready(function() {
                $('#collapse-btn').click(function() {
                    $('#collapse-content').toggle();
                });
            });
        </script>

        <!-- Include JavaScript files -->
        @yield('scripts')
    </body>
</html>
