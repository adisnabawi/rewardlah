<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Impackhack - Rewardlah">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="adis">
       
        <title>Rewardlah</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
        <link href="{{ url('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">

        <link href="{{ url('assets/css/main.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/css/custom.css') }}" rel="stylesheet">

    </head>
    <body class="login-page">
        <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
              <span class='sr-only'>Loading...</span>
            </div>
          </div>
        <div class="container">
            <div class="row justify-content-md-center">
                @yield('content')
            </div>
        </div>
        <script src="{{ url('assets/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="https://unpkg.com/feather-icons@4.29.0/dist/feather.min.js"></script>
        <script src="{{ url('assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ url('assets/js/main.min.js') }}"></script>
    </body>
</html>