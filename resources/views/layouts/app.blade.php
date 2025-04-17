
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SuratApp')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- KaiAdmin Styles -->
    <link href="{{ asset('kaiadmin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('kaiadmin/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('kaiadmin/assets/css/icons.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Header -->
    @include('layouts.header')

    <!-- Main Content -->
    <main class="main-content p-4">
        @yield('content')
    </main>

    <!-- KaiAdmin Scripts -->
    <script src="{{ asset('kaiadmin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('kaiadmin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('kaiadmin/assets/js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>
