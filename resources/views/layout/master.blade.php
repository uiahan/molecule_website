<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <title>@yield('title')</title>
</head>

<body style="background-color: #f4f4f4; margin: 0; padding: 0; max-width: 100%; overflow-x: hidden;">
    @yield('content')

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    
    <!-- Lightbox JS -->
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
    
    <!-- jQuery (required for Toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "7000", // Display duration
                "extendedTimeOut": "2000", // Hover duration
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            // Display Toastr notification if there's a session message
            @if (session('notif'))
                toastr.success("{{ session('notif') }}");
            @endif
        });
    </script>

    <style>
        .toast {
            opacity: 0.9 !important; /* Set opacity for toast */
            background-color: #00983d !important; /* Green background */
            padding: 15px 20px; /* Padding for the toast */
            margin: 10px; /* Margin around the toast */
            transition: transform 0.2s ease, opacity 0.2s ease; /* Transition effects */
        }

        .toast:hover {
            transform: scale(1.01); /* Scale effect on hover */
        }

        .toast .toast-message {
            color: #ffffff; /* White text for the message */
        }
    </style>
</body>

</html>