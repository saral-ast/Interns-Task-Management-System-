<x-layout>
    <x-navigation>
        <div class="py-8">
            <div class="max-w-full mx-auto px-4">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-4 lg:p-6 bg-white border-b border-gray-200">
                        <!-- Chat container with fixed dimensions -->
                        <div class="flex h-[600px] rounded-xl shadow-2xl overflow-hidden">
                            <!-- Users List with fixed width -->
                            <div class="w-[300px] border-r border-gray-200 bg-gray-50 rounded-l-xl flex flex-col overflow-hidden">
                                <h3 class="text-lg font-semibold text-gray-900 p-4 sticky top-0 bg-gray-50/95 backdrop-blur-sm border-b border-gray-200 z-10 flex items-center">
                                    <svg class="h-5 w-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                    </svg>
                                    Chat List
                                </h3>

                                <div class="flex-1 overflow-y-auto">
                                    @if($userType === 'admin')
                                        <div class="mb-6">
                                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2 bg-gray-100/80 backdrop-blur-sm sticky top-0 z-[5]">Interns</h4>
                                            <div class="space-y-1">
                                                @foreach($interns as $intern)
                                                    <button 
                                                        class="w-full text-left px-4 py-3 hover:bg-indigo-50/80 transition-all duration-200 user-select group relative"
                                                        data-user-type="intern"
                                                        data-user-id="{{ $intern->id }}"
                                                        data-user-name="{{ $intern->name }}"
                                                    >
                                                        <div class="flex items-center space-x-3">
                                                            <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 group-hover:bg-indigo-200 transition-colors duration-200 shadow-sm relative">
                                                                <span class="text-base font-semibold text-indigo-800">{{ substr($intern->name, 0, 1) }}</span>
                                                                @if($intern->unread_count > 0)
                                                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center notification-badge" data-user-type="intern" data-user-id="{{ $intern->id }}">
                                                                        {{ $intern->unread_count }}
                                                                    </span>
                                                                @endif
                                                            </span>
                                                            <div>
                                                                <span class="text-sm font-medium text-gray-900 group-hover:text-indigo-600">{{ $intern->name }}</span>
                                                                <p class="text-xs text-gray-500">Click to chat</p>
                                                            </div>
                                                        </div>
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="mb-6">
                                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2 bg-gray-100/80 backdrop-blur-sm sticky top-0 z-[5]">Administrators</h4>
                                            <div class="space-y-1">
                                                @foreach($admins as $admin)
                                                    <button 
                                                        class="w-full text-left px-4 py-3 hover:bg-indigo-50/80 transition-all duration-200 user-select group relative"
                                                        data-user-type="admin"
                                                        data-user-id="{{ $admin->id }}"
                                                        data-user-name="{{ $admin->name }}"
                                                    >
                                                        <div class="flex items-center space-x-3">
                                                            <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 group-hover:bg-indigo-200 transition-colors duration-200 shadow-sm relative">
                                                                <span class="text-base font-semibold text-indigo-800">{{ substr($admin->name, 0, 1) }}</span>
                                                                @if($admin->unread_count > 0)
                                                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center notification-badge" data-user-type="admin" data-user-id="{{ $admin->id }}">
                                                                        {{ $admin->unread_count }}
                                                                    </span>
                                                                @endif
                                                            </span>
                                                            <div>
                                                                <span class="text-sm font-medium text-gray-900 group-hover:text-indigo-600">{{ $admin->name }}</span>
                                                                <p class="text-xs text-gray-500">Click to chat</p>
                                                            </div>
                                                        </div>
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Chat Area with fixed header and footer -->
                            <div class="flex-1 flex flex-col bg-white rounded-r-xl overflow-hidden">
                                <!-- Fixed header with improved styling -->
                                <div id="chat-header" class="px-6 py-4 border-b border-gray-200 hidden bg-white z-10 shadow-sm flex-shrink-0">
                                    <div class="flex items-center space-x-4">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 shadow-md transition-colors duration-200">
                                            <span id="chat-user-initial" class="text-lg font-semibold text-indigo-800"></span>
                                        </span>
                                        <div>
                                            <h3 id="chat-user-name" class="text-lg font-semibold text-gray-900"></h3>
                                            <div class="flex items-center">
                                                <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                                                <p class="text-xs text-gray-500">Online</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Scrollable messages container - critical fix -->
                                <div id="messages-container" class="flex-1 overflow-y-scroll px-4 py-3 hidden bg-gray-50/50 w-full">
                                    <div class="flex flex-col space-y-2 min-h-full w-full">
                                        <!-- Messages will be loaded here -->
                                    </div>
                                </div>

                                <!-- Fixed footer with message form -->
                                <div id="message-form" class="p-4 border-t border-gray-200 hidden bg-white z-10 shadow-inner flex-shrink-0">
                                    <form id="send-message-form" class="flex items-center space-x-2">
                                        <input type="hidden" id="receiver_type" name="receiver_type">
                                        <input type="hidden" id="receiver_id" name="receiver_id">
                                        <div class="flex-1 relative">
                                            <input 
                                                type="text" 
                                                id="message-input" 
                                                name="content" 
                                                class="w-full rounded-lg border border-gray-300 px-4 py-3 shadow-sm focus:border-blue-400 focus:ring-1 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200 outline-none text-sm"
                                                placeholder="Type your message..."
                                            >
                                        </div>
                                        <button 
                                            type="submit"
                                            class="inline-flex items-center justify-center w-12 h-12 bg-indigo-600 rounded-full text-white hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-md"
                                        >
                                            <svg class="h-5 w-5 rotate-90" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <!-- No chat selected state with improved styling -->
                                <div id="no-chat-selected" class="flex-1 flex items-center justify-center bg-gray-50/50">
                                    <div class="text-center space-y-4 p-6 max-w-sm mx-auto">
                                        <div class="mx-auto h-20 w-20 text-gray-400 bg-gray-100 rounded-full flex items-center justify-center shadow-inner">
                                            <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-900">No conversation selected</h3>
                                            <p class="text-sm text-gray-500 mt-1">Choose a person from the list to start chatting</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-navigation>

    @push('scripts')
    <style>
        /* Enhanced message bubbles */
        .message-bubble-sent {
            background: linear-gradient(135deg, #3B82F6, #2563EB);
            border-radius: 18px 18px 0 18px;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
            white-space: pre-wrap;
        }
        
        .message-bubble-received {
            background: #fff;
            border-radius: 18px 18px 18px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
            white-space: pre-wrap;
        }

        /* Make sure the container takes full height */
        #messages-container {
            display: flex;
            flex-direction: column;
            min-height: 0;
            height: calc(100% - 50px); /* Adjust for header and footer */
            overflow-y: auto;
            scroll-behavior: smooth;
            scrollbar-width: thin;
            scrollbar-color: rgba(156, 163, 175, 0.5) rgba(229, 231, 235, 0.3);
        }

        #messages-container::-webkit-scrollbar {
            width: 6px;
        }
        
        #messages-container::-webkit-scrollbar-track {
            background: rgba(229, 231, 235, 0.3);
        }
        
        #messages-container::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 3px;
        }

        /* Fix chat container heights */
        .flex.h-\[600px\] {
            height: 600px;
            max-height: 600px;
            min-height: 600px;
        }
        
        #messages-container {
            overflow-y: scroll;
            -webkit-overflow-scrolling: touch;
            height: 100%;
        }
        
        #messages-container > div {
            width: 100%;
            padding-bottom: 15px;
        }
    </style>
    
   <script>
    // Initialize variables
    const messagesContainer = $('#messages-container');
    const messagesWrapper = $('#messages-container > div');
    const messageForm = $('#message-form');
    const chatHeader = $('#chat-header');
    const noChatSelected = $('#no-chat-selected');
    const messageInput = $('#message-input');
    
    // Track channel subscription to prevent duplicates
    let isSubscribed = false;
    let currentChannel = null;
    
    // Current conversation info
    let currentReceiverType = null;
    let currentReceiverId = null;
    
    // Initialize the poll interval for unread messages
    let unreadPollInterval = null;

    // Function to initialize Echo listeners
    function initializeEchoListeners() {
        // Check if Echo is properly initialized
        if (window.Echo) {
            try {
                // Only subscribe once to avoid duplicate subscriptions
                if (isSubscribed) {
                    return true;
                }
                
                // Create the channel name
                const channelName = `chat.{{ $userType }}.{{ $currentUser->id }}`;
                
                // Store channel reference to prevent garbage collection
                currentChannel = window.Echo.private(channelName);
                
                // Listen for incoming messages using Laravel Echo
                currentChannel.listen('MessageSent', (data) => {
                    // Check if this message belongs to the currently open chat
                    const currentReceiverId = $('#receiver_id').val();
                    const currentReceiverType = $('#receiver_type').val();
                    
                    // Show message if it's part of the current conversation
                    if ((data.message.sender_type === currentReceiverType && parseInt(data.message.sender_id) === parseInt(currentReceiverId)) || 
                        (data.message.receiver_type === currentReceiverType && parseInt(data.message.receiver_id) === parseInt(currentReceiverId))) {
                        
                        // Determine if this is our own message or from the other person
                        const isOwn = data.message.sender_type === '{{ $userType }}' && 
                                     parseInt(data.message.sender_id) === {{ $currentUser->id }};
                                     
                        appendMessage(data.message, isOwn);
                        scrollToBottom();
                        
                        // Mark message as read if it's incoming and we're in the conversation
                        if (!isOwn) {
                            markMessageAsRead(data.message.id);
                        }
                    } else {
                        // Message is for a different conversation, update the notification badge
                        if (data.message.receiver_type === '{{ $userType }}' && 
                            parseInt(data.message.receiver_id) === {{ $currentUser->id }}) {
                            
                            // Update or create a notification badge
                            updateNotificationBadge(data.message.sender_type, data.message.sender_id);
                        }
                    }
                });

                // Alternative binding syntax in case the first method doesn't work
                window.Echo.private(channelName)
                    .on('MessageSent', (data) => {
                        // Processing handled by the other listener
                    });
                
                isSubscribed = true;
                return true;
            } catch (error) {
                return false;
            }
        } else {
            return false;
        }
    }

    // Function to update notification badge
    function updateNotificationBadge(userType, userId) {
        // Fetch the current unread count
        $.ajax({
            url: '/messages/unread-counts',
            method: 'GET',
            success: function(response) {
                // Update each notification badge
                Object.keys(response).forEach(key => {
                    const count = response[key];
                    const [type, id] = key.split('_');
                    
                    let badge = $(`.notification-badge[data-user-type="${type}"][data-user-id="${id}"]`);
                    
                    if (count > 0) {
                        if (badge.length) {
                            // Update existing badge
                            badge.text(count);
                        } else {
                            // Create new badge
                            const newBadge = $('<span>')
                                .addClass('absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center notification-badge')
                                .attr('data-user-type', type)
                                .attr('data-user-id', id)
                                .text(count);
                                
                            $(`.user-select[data-user-type="${type}"][data-user-id="${id}"] .inline-flex`).append(newBadge);
                        }
                    } else if (badge.length) {
                        // Remove badge if count is 0
                        badge.remove();
                    }
                });
            }
        });
    }

    // Function to start polling for unread messages
    function startUnreadMessagePolling() {
        // Clear any existing interval
        stopUnreadMessagePolling();
        
        // Poll every 10 seconds
        unreadPollInterval = setInterval(function() {
            // Don't update for the current conversation
            if (currentReceiverType && currentReceiverId) {
                $.ajax({
                    url: '/messages/unread-counts',
                    method: 'GET',
                    success: function(response) {
                        // Update each notification badge except current conversation
                        Object.keys(response).forEach(key => {
                            const [type, id] = key.split('_');
                            
                            // Skip current conversation
                            if (type === currentReceiverType && parseInt(id) === parseInt(currentReceiverId)) {
                                return;
                            }
                            
                            const count = response[key];
                            let badge = $(`.notification-badge[data-user-type="${type}"][data-user-id="${id}"]`);
                            
                            if (count > 0) {
                                if (badge.length) {
                                    // Update existing badge
                                    badge.text(count);
                                } else {
                                    // Create new badge
                                    const newBadge = $('<span>')
                                        .addClass('absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center notification-badge')
                                        .attr('data-user-type', type)
                                        .attr('data-user-id', id)
                                        .text(count);
                                        
                                    $(`.user-select[data-user-type="${type}"][data-user-id="${id}"] .inline-flex`).append(newBadge);
                                }
                            } else if (badge.length) {
                                // Remove badge if count is 0
                                badge.remove();
                            }
                        });
                    }
                });
            }
        }, 10000); // 10 seconds
    }

    // Function to stop polling
    function stopUnreadMessagePolling() {
        if (unreadPollInterval) {
            clearInterval(unreadPollInterval);
            unreadPollInterval = null;
        }
    }

    // Try to initialize Echo listeners when the page loads
    let echoInitialized = initializeEchoListeners();
    
    // Also initialize when Echo is connected (from bootstrap.js)
    window.addEventListener('echoConnected', () => {
        initializeEchoListeners();
    });
    
    // If not successful, retry a few times with delay
    if (!echoInitialized) {
        let retryCount = 0;
        const maxRetries = 5;
        const retryInterval = setInterval(() => {
            retryCount++;
            
            echoInitialized = initializeEchoListeners();
            
            if (echoInitialized || retryCount >= maxRetries) {
                clearInterval(retryInterval);
            }
        }, 1000);
    }

    // Start unread message polling when the page loads
    startUnreadMessagePolling();

    $('.user-select').click(function() {
        const userType = $(this).data('user-type');
        const userId = $(this).data('user-id');
        const userName = $(this).data('user-name');

        // Store current conversation info
        currentReceiverType = userType;
        currentReceiverId = userId;

        // Highlight the selected user
        $('.user-select').removeClass('bg-indigo-50');
        $(this).addClass('bg-indigo-50');

        $('#chat-user-name').text(userName);
        $('#chat-user-initial').text(userName.charAt(0));
        $('#receiver_type').val(userType);
        $('#receiver_id').val(userId);

        chatHeader.removeClass('hidden');
        messagesContainer.removeClass('hidden').css('display', 'block');
        messageForm.removeClass('hidden');
        noChatSelected.addClass('hidden');

        // Remove notification badge for this user
        $(`.notification-badge[data-user-type="${userType}"][data-user-id="${userId}"]`).remove();

        loadMessages(userType, userId);
    });

    $('#send-message-form').submit(function(e) {
        e.preventDefault();
        const content = messageInput.val().trim();
        if (!content) return;

        const receiverType = $('#receiver_type').val();
        const receiverId = $('#receiver_id').val();

        // Show immediate feedback by displaying the message
        const tempMessage = {
            content: content,
            created_at: new Date(),
            sender_type: '{{ $userType }}',
            sender_id: {{ $currentUser->id }},
            receiver_type: receiverType,
            receiver_id: receiverId
        };
        
        // Display the message immediately
        appendMessage(tempMessage, true);
        scrollToBottom();
        
        // Clear the input field
        messageInput.val('');
        
        // Now send to server
        $.ajax({
            url: '{{ route("messages.store") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                content: content,
                receiver_type: receiverType,
                receiver_id: receiverId
            },
            success: function(response) {
                // Message sent successfully
            },
            error: function(xhr) {
                // Show error message to user
                alert('Failed to send message. Please try again.');
            }
        });
    });

    function loadMessages(receiverType, receiverId) {
        // Clear existing messages
        messagesWrapper.empty();
        
        $.ajax({
            url: '{{ route("messages.get") }}',
            method: 'GET',
            data: {
                receiver_type: receiverType,
                receiver_id: receiverId
            },
            success: function(messages) {
                if (messages.length > 0) {
                    messages.forEach(message => {
                        const isOwn = message.sender_type === '{{ $userType }}' && 
                                     parseInt(message.sender_id) === {{ $currentUser->id }};
                        
                        appendMessage(message, isOwn);
                        
                        // Mark all incoming messages as read
                        if (!isOwn && !message.read_at) {
                            markMessageAsRead(message.id);
                        }
                    });
                    scrollToBottom();
                }
            },
            error: function(xhr) {
                // Error handling
            }
        });
    }

    function appendMessage(message, isOwn) {
        const messageElement = $('<div>')
            .addClass('flex mb-3 w-full ' + (isOwn ? 'justify-end' : 'justify-start'));

        const messageWrapper = $('<div>')
            .addClass('flex flex-col ' + (isOwn ? 'items-end' : 'items-start') + ' max-w-[80%]');

        const messageContent = $('<div>') 
            .addClass('inline-block px-4 py-2 break-words ' + 
                     (isOwn ? 'message-bubble-sent text-white' : 'message-bubble-received text-gray-800 border border-gray-100'))
            .text(message.content);

        const timeStamp = $('<span>')
            .addClass('text-xs text-gray-400 mt-1 px-2')
            .text(new Date(message.created_at || Date.now()).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }));

        messageWrapper.append(messageContent, timeStamp);
        messageElement.append(messageWrapper);
        messagesWrapper.append(messageElement);
    }

    function scrollToBottom() {
        const container = document.getElementById('messages-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    }

    function markMessageAsRead(messageId) {
        $.ajax({
            url: `/messages/${messageId}/read`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function() {
                // After marking the message as read, update the notification badges
                updateNotificationBadge(currentReceiverType, currentReceiverId);
            }
        });
    }

    // Auto focus on message input when chat is selected
    $(document).on('click', '.user-select', function() {
        setTimeout(() => {
            messageInput.focus();
        }, 100);
    });
    
    // Update notification badges when the page becomes visible again
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            updateNotificationBadge();
        }
    });
   </script>
    @endpush
</x-layout>