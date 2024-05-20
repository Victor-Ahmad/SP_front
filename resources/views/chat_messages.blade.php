@extends('layouts.master')

@section('title', 'Chats Messages')
@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <style>
        .chat-container {
            display: flex;
            flex-direction: column;
            height: 80vh;
            margin: 20px auto;
            max-width: 800px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .chat-messages {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            display: flex;
            flex-direction: column-reverse;
        }

        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            max-width: 60%;
        }

        .message.sender {
            align-self: flex-end;
            background-color: #d1f7d1;
        }

        .message.receiver {
            align-self: flex-start;
            background-color: #f1f1f1;
        }

        .chat-input {
            padding: 10px;
            border-top: 1px solid #ddd;
            display: flex;
            align-items: center;
        }

        .chat-input input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .chat-input button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .chat-input button:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('content')
    <div class="chat-container">
        <div class="chat-messages" id="chat-messages">
            @foreach ($chat['messages']['data'] as $message)
                <div class="message {{ $message['type'] }}">
                    <p>{{ $message['message'] }}</p>
                    <small>{{ \Carbon\Carbon::parse($message['created_at'])->format('d M Y, h:i A') }}</small>
                </div>
            @endforeach
        </div>
        <div class="chat-input">
            <input type="text" id="message-input" placeholder="Type a message...">
            <button id="send-button">Send</button>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chatMessages = document.getElementById('chat-messages');
            var page = 1;
            var chatId = {{ $chat['chat']['id'] }};
            var loading = false;

            chatMessages.addEventListener('scroll', function() {
                if (chatMessages.scrollTop === chatMessages.scrollHeight - chatMessages.clientHeight && !
                    loading) {
                    loading = true;
                    page++;
                    fetchMoreMessages(chatId, page);
                }
            });

            function fetchMoreMessages(chatId, page) {
                var url = "{{ route('chat_messages.show', ['id' => ':id']) }}".replace(':id', chatId) + '?page=' +
                    page;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        var newMessages = data.messages.data.map(message => {
                            return `<div class="message ${message.type}">
                                    <p>${message.message}</p>
                                    <small>${new Date(message.created_at).toLocaleString()}</small>
                                </div>`;
                        }).join('');
                        chatMessages.innerHTML = newMessages + chatMessages.innerHTML;
                        loading = false;
                    })
                    .catch(error => console.error('Error fetching messages:', error));
            }

            document.getElementById('send-button').addEventListener('click', function() {
                var messageInput = document.getElementById('message-input');
                var message = messageInput.value;

                // Code to send message to the server
                // ...

                messageInput.value = '';
            });
        });
    </script>
@endsection
