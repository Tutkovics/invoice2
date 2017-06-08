<html>
    <head>
        <title>@yield('title')</title>


        <link rel="shortcut icon" type="image/png" href="https://cdn2.iconfinder.com/data/icons/media-and-communication/164/13-128.png"/>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="{!! asset('/css/main.css') !!}">
    </head>
    <body>
        @yield('navbar')
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>