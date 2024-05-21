@extends('layouts.master')

@section('title', 'Profile')

@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        .profile-container {
            max-width: 800px;
            margin: 15vh auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .profile-container:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
            border: 3px solid #3498db;
        }

        .profile-header .name {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
        }

        .edit-button {
            margin-left: auto;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .edit-button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        .profile-details,
        .house-details {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .profile-details .detail,
        .house-details .detail {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #ecf0f1;
        }

        .profile-details .detail span,
        .house-details .detail span {
            font-size: 16px;
        }

        .profile-details .detail .label,
        .house-details .detail .label {
            color: #7f8c8d;
            font-weight: 500;
        }

        .profile-details .detail .value,
        .house-details .detail .value {
            font-weight: 600;
            color: #2c3e50;
        }

        .house-details {
            margin-top: 30px;
        }

        .house-details h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #2c3e50;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }

        .save-button {
            margin-top: 30px;
            background-color: #2ecc71;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .save-button:hover {
            background-color: #27ae60;
            transform: scale(1.05);
        }

        .editable {
            border: 1px solid #ecf0f1;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            color: black !important;
        }

        .editable:disabled {
            background-color: #f4f4f9;
            border-color: #ecf0f1;
            color: #2a81b2 !important;
        }

        .profile-container h2 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div id="pagee" class="clearfix">
        <div class="profile-container">
            <div class="profile-header">
                <img src="https://via.placeholder.com/100" alt="Profile Picture">
                <div class="name">{{ $profile['first_name'] }} {{ $profile['last_name'] }}</div>
                <button class="edit-button" id="edit-button">Edit</button>
            </div>

            <h2>Profile Information</h2>
            <form id="profile-form" action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="profile-details">
                    <div class="detail">
                        <span class="label">Email:</span>
                        <span class="value"><input type="email" name="email" value="{{ $profile['email'] }}"
                                class="editable" disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">Phone Number:</span>
                        <span class="value"><input type="text" name="number" value="{{ $profile['number'] }}"
                                class="editable" disabled></span>
                    </div>
                </div>

                <h2>House Details</h2>
                <div class="house-details">
                    <div class="detail">
                        <span class="label">Location:</span>
                        <span class="value"><input type="text" name="location"
                                value="{{ $profile['one_to_one_swap_house']['location'] }}" class="editable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">Post Code:</span>
                        <span class="value"><input type="text" name="post_code"
                                value="{{ $profile['one_to_one_swap_house']['post_code'] }}" class="editable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">Street:</span>
                        <span class="value"><input type="text" name="street"
                                value="{{ $profile['one_to_one_swap_house']['street'] }}" class="editable" disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">House Number:</span>
                        <span class="value"><input type="text" name="house_number"
                                value="{{ $profile['one_to_one_swap_house']['house_number'] }}" class="editable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">Number of Rooms:</span>
                        <span class="value"><input type="number" name="number_of_rooms"
                                value="{{ $profile['one_to_one_swap_house']['number_of_rooms'] }}" class="editable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">Rent Price:</span>
                        <span class="value"><input type="number" step="0.01" name="price"
                                value="{{ $profile['one_to_one_swap_house']['price'] }}" class="editable" disabled></span>
                    </div>
                </div>
                <button type="submit" class="save-button" id="save-button" style="display: none;">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('edit-button').addEventListener('click', function() {
            var inputs = document.querySelectorAll('.editable');
            inputs.forEach(function(input) {
                input.disabled = !input.disabled;
            });

            var saveButton = document.getElementById('save-button');
            if (inputs[0].disabled) {
                saveButton.style.display = 'none';
                this.innerText = 'Edit';
            } else {
                saveButton.style.display = 'block';
                this.innerText = 'Cancel';
            }
        });
    </script>
@endsection

@section('additional_scripts')
@endsection
