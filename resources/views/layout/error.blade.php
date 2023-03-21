<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

         <!-- Layout styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    </head>
    <body>
                    @yield('message_content')
    </body>
</html>
