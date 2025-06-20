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
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Common CSS -->
    <link href="{{ asset('files/js-css/app.css') }}" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('files/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}">

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('files/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('files/js-css/app.js') }}"></script>

    <!-- Plugin JS -->
    <script src="{{ asset('files/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('files/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

    <!-- Common JS -->
    <script src="{{ asset('files/js/template.js') }}"></script>
    <script src="{{ asset('files/js/dashboard.js') }}"></script>
    
    <!-- Feather Icons JS - Loaded last to ensure it runs after all other scripts -->
    <script src="{{ asset('files/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('files/js/feather-icons-init.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('files/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('files/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>

    @stack('scripts')

    <style>
        html, body, .main-wrapper, .page-wrapper {
            min-height: 100vh;
            height: 100%;
        }
        .page-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .page-wrapper > *:not(.footer) {
            flex-shrink: 0;
        }
        .footer {
            margin-top: auto;
        }
    </style>
</body>
</html>