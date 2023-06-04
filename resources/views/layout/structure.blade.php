<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
     <!-- plugins:css -->
     <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
     <!-- Layout styles -->
     <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
     <!-- End layout styles -->
     <link rel="shortcut icon" href="{{ asset('assets/images/LOGO_ASISQUICK.png') }}" />
     
</head>
<body>
    @yield('content')
    @include('sweetalert::alert')

</body>
</html>