<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Impackhack Hackathon - Rewardlah">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="adis">

    <title>RewardLah</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
    <link href="{{ url('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ url('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">


    <link href="{{ url('assets/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/custom.css') }}" rel="stylesheet">

</head>

<body>
    <div class="page-container">
        @include('layouts.header')
        @include('layouts.sidebar')
        <div class="page-content">
            <div class="main-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="{{ url('assets/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="{{ url('assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    @if (Route::currentRouteName() == 'dashboard.index')
    <script src="{{ url('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/dashboard.js') }}"></script>
    @endif
    <script src="{{ url('assets/js/main.min.js') }}"></script>
    
    @stack('scripts')
</body>

</html>