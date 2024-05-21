@extends('layouts.master')

@section('title', 'Profile')
@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <style>
        .profile-container {
            max-width: 800px;
            margin: 15vh auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 20px;
        }

        .profile-header .name {
            font-size: 24px;
            font-weight: bold;
            color: #2a81b2;
        }

        .profile-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .profile-details .detail {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .profile-details .detail span {
            font-size: 16px;
        }

        .profile-details .detail .label {
            color: #555;
        }

        .profile-details .detail .value {
            font-weight: bold;
            color: #333;
        }

        .house-details {
            margin-top: 30px;
        }

        .house-details h3 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #2a81b2;
        }

        .house-details .detail {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .house-details .detail span {
            font-size: 16px;
        }

        .house-details .detail .label {
            color: #555;
        }

        .house-details .detail .value {
            font-weight: bold;
            color: #333;
        }


        /* .background_color {
                background: linear-gradient(135deg, #2a81b2, white) !important;
                min-height: 87vh;
            } */
    </style>
@endsection

@section('content')
    <div id="pagee" class="clearfix background_color">

        <div class="profile-container">
            <div class="profile-header">
                <img src="https://via.placeholder.com/80" alt="Profile Picture">
                <div class="name">{{ $profile['first_name'] }} {{ $profile['last_name'] }}</div>
            </div>

            <div class="profile-details">
                <div class="detail">
                    <span class="label">Email:</span>
                    <span class="value">{{ $profile['email'] }}</span>
                </div>
                <div class="detail">
                    <span class="label">Phone Number:</span>
                    <span class="value">{{ $profile['number'] }}</span>
                </div>
                <div class="detail">
                    <span class="label">Created At:</span>
                    <span class="value">{{ \Carbon\Carbon::parse($profile['created_at'])->format('d M Y, h:i A') }}</span>
                </div>
            </div>

            <div class="house-details">
                <h3>House Details</h3>
                <div class="detail">
                    <span class="label">Location:</span>
                    <span class="value">{{ $profile['one_to_one_swap_house']['location'] }}</span>
                </div>
                <div class="detail">
                    <span class="label">Post Code:</span>
                    <span class="value">{{ $profile['one_to_one_swap_house']['post_code'] }}</span>
                </div>
                <div class="detail">
                    <span class="label">Street:</span>
                    <span class="value">{{ $profile['one_to_one_swap_house']['street'] }}</span>
                </div>
                <div class="detail">
                    <span class="label">House Number:</span>
                    <span class="value">{{ $profile['one_to_one_swap_house']['house_number'] }}</span>
                </div>
                <div class="detail">
                    <span class="label">Number of Rooms:</span>
                    <span class="value">{{ $profile['one_to_one_swap_house']['number_of_rooms'] }}</span>
                </div>
                <div class="detail">
                    <span class="label">Rent Price:</span>
                    <span class="value">{{ number_format($profile['one_to_one_swap_house']['price'], 2) }}</span>
                </div>
                <div class="detail">
                    <span class="label">Created At:</span>
                    <span
                        class="value">{{ \Carbon\Carbon::parse($profile['one_to_one_swap_house']['created_at'])->format('d M Y, h:i A') }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')

@endsection
