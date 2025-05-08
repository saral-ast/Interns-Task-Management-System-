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

    <!-- Pusher Configuration -->
    <script>
        window.PusherConfig = {
            key: '{{ env('PUSHER_APP_KEY') }}',
            cluster: '{{ env('PUSHER_APP_CLUSTER', 'ap2') }}',
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

    <!-- Chat Unread Message Count Script -->
    <script>
        $(document).ready(function() {
            // Function to update the chat unread count
            function updateChatUnreadCount() {
                $.ajax({
                    url: '{{ route("messages.total-unread") }}',
                    method: 'GET',
                    success: function(response) {
                        const unreadCount = parseInt(response);
                        const chatUnreadBadge = $('#chat-unread-count');
                        
                        if (unreadCount > 0) {
                            chatUnreadBadge.text(unreadCount).removeClass('hidden');
                        } else {
                            chatUnreadBadge.addClass('hidden');
                        }
                    }
                });
            }
            
            // Update the chat unread count when the page loads
            updateChatUnreadCount();
            
            // Update the chat unread count every 10 seconds
            setInterval(updateChatUnreadCount, 10000);
            
            // Also update when the page becomes visible again
            document.addEventListener('visibilitychange', function() {
                if (!document.hidden) {
                    updateChatUnreadCount();
                }
            });
            
            // Listen for echo broadcast events
            if (window.Echo) {
                const isAdmin = {{ Auth::guard('admin')->check() ? 'true' : 'false' }};
                const userId = {{ Auth::guard('admin')->check() ? Auth::guard('admin')->id() : Auth::guard('user')->id() }};
                const userType = isAdmin ? 'admin' : 'intern';
                
                window.Echo.private(`chat.${userType}.${userId}`)
                    .listen('MessageSent', () => {
                        updateChatUnreadCount();
                    });
            }
        });
    </script>

    <!-- ✅ Your custom scripts -->
    @stack('scripts')
</body>
</html>
