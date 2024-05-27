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
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            text-decoration: none;
            width: 100%;
        }

        .chat-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background-color: #f0f0f0;
        }

        .chat-card .name {
            font-size: 18px;
            font-weight: bold;
            display: flex;
            align-items: center;
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
            min-height: 83vh;
            padding: 0 20vw;
        }

        .background_color {
            min-height: 87vh;
        }

        .single_badge {
            background-color: red;
            color: white;
            border-radius: 50%;
            width: 10px;
            height: 10px;
            display: inline-block;
            margin-right: 5px;
        }

        /* Large Devices (laptops/desktops, 992px to 1200px) */
        @media (max-width: 1200px) {}

        /* Medium Devices (landscape tablets, 768px to 992px) */
        @media (max-width: 992px) {}


        /* Small Devices (portrait tablets and large phones, 600px to 768px) */
        @media (max-width: 768px) {}

        /* Extra Small Devices (phones, 600px and down) */
        @media (max-width: 600px) {
            .chat-container {
                padding: 0;
            }
        }
    </style>
@endsection

@section('content')
    <div id="pagee" class="clearfix background_color">
        <div class="chat-container">
            @if (count($chats) > 0)
                @foreach ($chats as $chat)
                    <a href="{{ route('chat.show', ['id' => $chat['id']]) }}" class="chat-card">
                        <div class="chat-info">
                            <div class="name">
                                @if ($chat['unread'] == '1')
                                    <span class="single_badge"></span>
                                @endif
                                {{ $chat['other_person']['first_name'] }}
                                {{ $chat['other_person']['last_name'] }}
                            </div>
                            <div class="email">{{ $chat['other_person']['location'] }},
                                {{ $chat['other_person']['street'] }}</div>
                        </div>
                        <div class="created-at">{{ \Carbon\Carbon::parse($chat['updated_at'])->format('d M Y, h:i A') }}
                        </div>
                    </a>
                @endforeach
            @else
                <p>@lang('lang.no chats yet')</p>
            @endif
        </div>
    </div>
@endsection

@section('additional_scripts')
@endsection
