<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Interns Task Management') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Reverb Configuration -->
    <script>
        window.ReverbConfig = {
            key: '{{ env('REVERB_APP_KEY', 'app-key') }}',
            host: '{{ env('REVERB_HOST', '127.0.0.1') }}',
            port: '{{ env('REVERB_PORT', '8080') }}',
            scheme: '{{ env('REVERB_SCHEME', 'http') }}',
        };
    </script>

    <!-- App CSS/JS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ✅ SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>

    <!-- jQuery and jQuery Validation Plugin -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <main>
        {{ $slot }}
    </main>

    <!-- ✅ Your custom scripts -->
    @stack('scripts')
</body>
</html>
