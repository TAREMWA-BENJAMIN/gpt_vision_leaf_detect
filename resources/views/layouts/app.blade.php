<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AI Powered Plant Disease Detector</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet">

    <!-- Plugin CSS -->
    <link href="{{ asset('files/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('files/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('files/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />

    <!-- Common CSS -->
    <link href="{{ asset('files/js-css/app.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="main-wrapper" id="app">
        @include('layouts.partials.sidebar')
        <div class="page-wrapper">
            @include('layouts.partials.header')
            @yield('content')
            @include('layouts.partials.footer')
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('files/js-css/app.js') }}"></script>
    <script src="{{ asset('files/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('files/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <!-- Plugin JS -->
    <script src="{{ asset('files/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('files/plugins/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Common JS -->
    <script src="{{ asset('files/js/template.js') }}"></script>
    <script src="{{ asset('files/js/dashboard.js') }}"></script>
    
    @stack('scripts')
</body>
</html>