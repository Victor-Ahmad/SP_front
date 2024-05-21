@extends('layouts.master')

@section('title', 'Chat Messages')
@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <style>
        .chat-window {
            display: flex;
            flex-direction: column;
            height: 80vh;
            margin: 40px auto;
            /* Added margin on top */
            max-width: 800px;
            border: 1px solid #236a8a;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            /* background: #fff; */

        }

        .background_color {
            /* background: linear-gradient(135deg, #2a81b2, white) !important; */
        }

        .chat-header {
            padding: 15px;
            background: #2a81b2;
            /* Updated color */
            color: white;
            font-size: 18px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .chat-messages-box {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            display: flex;
            flex-direction: column-reverse;
            background: #f9f9f9;
        }

        .chat-message {
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 20px;
            max-width: 70%;
            word-wrap: break-word;
            position: relative;
        }

        .chat-message.sender {
            align-self: flex-end;
            background-color: #d1f7d1;
            /* Updated color */
            border-bottom-right-radius: 0;
        }

        .chat-message.receiver {
            align-self: flex-start;
            background-color: #f1f1f1;
            /* Updated color */
            border-bottom-left-radius: 0;
        }

        .chat-message p {
            margin: 0;
            padding: 0;
            color: #333;
            /* Updated color */
        }

        .chat-message small {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            /* Smaller font size */
            color: #888;
            /* Updated color */
        }

        .chat-input-box {
            padding: 15px;
            border-top: 1px solid #ddd;
            display: flex;
            align-items: center;
            background: #f1f1f1;
        }

        .chat-input-box input[type="text"] {
            flex-grow: 1;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 20px;
            margin-right: 10px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .chat-input-box input[type="text"]:focus {
            border-color: #2a81b2;
            color: #2a81b2;
        }

        .chat-input-box button {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            background-color: #2a81b2;
            /* Updated color */
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .chat-input-box button:hover {
            background-color: #236a8a;
            /* Updated color */
        }
    </style>
@endsection

@section('content')
    <div id="pagee" class="clearfix background_color" style="padding: 10vh 0">
        <div class="chat-window">
            <div class="chat-header">
                {{ $chat['chat']['other_person']['first_name'] }} {{ $chat['chat']['other_person']['last_name'] }} -
                {{ $chat['chat']['other_person']['location'] }}, {{ $chat['chat']['other_person']['street'] }}
            </div>
            <div class="chat-messages-box" id="chatMessagesBox">
                @foreach ($chat['messages'] as $message)
                    <div class="chat-message {{ $message['type'] }}">
                        <p>{{ $message['message'] }}</p>
                        <small>{{ \Carbon\Carbon::parse($message['created_at'])->format('d M Y, h:i A') }}</small>
                    </div>
                @endforeach
            </div>
            <div class="chat-input-box">
                <input type="text" id="messageInput" placeholder="Type a message...">
                <button id="sendButton">Send</button>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chatMessagesBox = document.getElementById('chatMessagesBox');
            var page = 1;
            var chatId = {{ $chat['chat']['id'] }};
            var receiverUserId = {{ $chat['chat']['other_person']['id'] }};
            var loading = false;

            chatMessagesBox.addEventListener('scroll', function() {
                if (chatMessagesBox.scrollTop === chatMessagesBox.scrollHeight - chatMessagesBox
                    .clientHeight && !loading) {
                    loading = true;
                    page++;
                    fetchMoreMessages(chatId, page);
                }
            });

            function fetchMoreMessages(chatId, page) {
                var url = "{{ route('chat.show', ['id' => ':id']) }}".replace(':id', chatId) + '?page=' + page;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        var newMessages = data.result[0].messages.data.map(message => {
                            return `<div class="chat-message ${message.type}">
                                    <p>${message.message}</p>
                                    <small>${new Date(message.created_at).toLocaleString()}</small>
                                </div>`;
                        }).join('');
                        chatMessagesBox.innerHTML = newMessages + chatMessagesBox.innerHTML;
                        loading = false;
                    })
                    .catch(error => console.error('Error fetching messages:', error));
            }

            document.getElementById('sendButton').addEventListener('click', function() {
                var messageInput = document.getElementById('messageInput');
                var message = messageInput.value;

                if (message.trim() === "") return;

                var formData = new FormData();
                formData.append('message', message);
                formData.append('receiver_user_id', receiverUserId);

                fetch('https://phplaravel-1239567-4545376.cloudwaysapps.com/api/send_message', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + '{{ Session::get('token') }}',
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            var newMessage = `<div class="chat-message sender">
                                            <p>${message}</p>
                                            <small>${new Date().toLocaleString()}</small>
                                          </div>`;
                            chatMessagesBox.innerHTML = newMessage + chatMessagesBox.innerHTML;
                            messageInput.value = '';
                        } else {
                            console.error('Error sending message:', data);
                        }
                    })
                    .catch(error => console.error('Error sending message:', error));
            });
        });
    </script>
@endsection
