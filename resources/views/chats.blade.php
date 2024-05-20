@extends('layouts.master')

@section('title', 'Chats')
@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <style>
        .chat-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            text-decoration: none;
            color: inherit;
            width: 100%;
            /* Ensure the cards take full width of the container */
            /* max-width: 600px; */
            /* Set a max width for the cards */
        }

        .chat-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .chat-card .name {
            font-size: 18px;
            font-weight: bold;
        }

        .chat-card .chat-info {
            display: flex;
            flex-direction: column;
        }

        .chat-container {
            display: flex;

            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 20px;
            min-height: 97vh;
            padding: 0 20vw;
        }
    </style>
@endsection

@section('content')
    <div class=" chat-container">
        @if (count($chats) > 0)
            @foreach ($chats as $chat)
                <a href="{{ route('chat_messages.show', ['id' => $chat['id']]) }}" class="chat-card">
                    <div class="chat-info">
                        <div class="name">{{ $chat['other_person']['first_name'] }}
                            {{ $chat['other_person']['last_name'] }}</div>
                        <div class="email">{{ $chat['other_person']['email'] }}</div>
                    </div>
                    <div class="created-at">{{ \Carbon\Carbon::parse($chat['updated_at'])->format('d M Y, h:i A') }}</div>
                </a>
            @endforeach
        @else
            <p>No chats available.</p>
        @endif
    </div>
@endsection

@section('additional_scripts')

@endsection
