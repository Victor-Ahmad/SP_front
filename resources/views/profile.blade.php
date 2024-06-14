@extends('layouts.master')

@section('title', 'Profile')

@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #fff;
            color: #333;
        }

        .profile-container {
            max-width: 60vw;
            margin: 15vh auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
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
            transition: transform 0.3s ease;
        }

        .profile-header img:hover {
            transform: scale(1.05);
        }

        .profile-header .name {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
        }

        .edit-button,
        .save-button,
        .delete-account-button {
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

        .save-button,
        .delete-account-button {
            background-color: #2ecc71;
        }

        .save-button:hover,
        .delete-account-button:hover {
            background-color: #27ae60;
            transform: scale(1.05);
        }

        .delete-account-button {
            background-color: red;
        }

        .delete-account-button:hover {
            background-color: rgb(179, 0, 0);
            transform: scale(1.05);
        }

        .tab-content {
            margin-top: 30px;
        }

        .tab-pane {
            animation: fadeEffect 0.5s;
        }

        @keyframes fadeEffect {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .detail {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #ecf0f1;
        }

        .detail span {
            font-size: 16px;
        }

        .detail .label {
            color: #7f8c8d;
            font-weight: 500;
        }

        .detail .value {
            font-weight: 600;
            color: #2c3e50;
            width: 40%;
        }

        .editable,
        .uneditable {
            border: 1px solid #ecf0f1;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            color: black !important;
        }

        .editable:disabled,
        .uneditable:disabled {
            background-color: #f4f4f9;
            border-color: #ecf0f1;
            color: #2a81b2 !important;
        }

        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .tag {
            background-color: #2981B2;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }

        .tag .remove-tag {
            margin-left: 10px;
            cursor: pointer;
        }

        .input-field {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            color: #2981B2;
        }

        .input-field:focus {
            border-color: #2981B2;
            box-shadow: 0 0 5px rgb(41, 129, 178);
            outline: none;
        }

        .dropdown {
            position: relative;
            width: 100%;
        }

        .dropdown input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            color: #2981B2;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            width: 100%;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            z-index: 1;
            border-radius: 10px;
            max-height: 200px;
            overflow-y: auto;
        }

        /* Adjustments for better mobile responsiveness */
        @media (max-width: 1024px) {
            .profile-container {
                max-width: 80vw;
            }

            .profile-header .name {
                font-size: 24px;
            }

            .edit-button {
                padding: 8px 16px;
            }

            .save-button,
            .delete-account-button {
                padding: 8px 16px;
            }

            .detail span {
                font-size: 14px;
            }
        }

        @media (max-width: 600px) {
            .profile-container {
                max-width: 90vw;
                margin: 5vh auto;
                padding: 20px;
            }

            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .profile-header img {
                width: 60px;
                height: 60px;
                margin: 0 0 10px 0;
            }

            .profile-header .name {
                font-size: 18px;
            }

            .edit-button,
            .save-button,
            .delete-account-button {
                margin-left: 0;
                margin-top: 10px;
                padding: 8px 16px;
            }

            .detail {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px 0;
            }

            .detail .label {
                width: 100%;
            }

            .detail .value {
                width: 100%;
            }

            .tag {
                padding: 5px 8px;
            }

            .input-field {
                padding: 10px;
            }

            .dropdown input {
                padding: 10px;
            }
        }

        /* Slider styles */
        .slider-container {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slider-item {
            min-width: 100%;
            box-sizing: border-box;
            padding: 10px;
            position: relative;
        }

        .slider img {
            width: 100%;
            border-radius: 10px;
        }

        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .slider-arrow-left {
            left: 10px;
        }

        .slider-arrow-right {
            right: 10px;
        }

        .delete-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 0, 0, 0.7);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            font-size: 16px;
            line-height: 25px;
            text-align: center;
            cursor: pointer;
            display: none;
        }

        .edit-mode .delete-button {
            display: block;
        }

        .image-container {
            position: relative;
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .image-container img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .image-container .delete-button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 100%;
            cursor: pointer;
            padding: 0 5px;
            font-size: 16px;
            color: #e74c3c;
            display: none;
        }

        .image-container.edit-mode .delete-button {
            display: block;
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

            <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-info-tab" data-toggle="tab" href="#profile-info" role="tab"
                        aria-controls="profile-info" aria-selected="true">@lang('lang.personal_information')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="house-location-tab" data-toggle="tab" href="#house-location" role="tab"
                        aria-controls="house-location" aria-selected="false">@lang('lang.your house location')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="house-details-tab" data-toggle="tab" href="#house-details" role="tab"
                        aria-controls="house-details" aria-selected="false">@lang('lang.your house')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="your-wishes-tab" data-toggle="tab" href="#your-wishes" role="tab"
                        aria-controls="your-wishes" aria-selected="false">@lang('lang.your wishes')</a>
                </li>
            </ul>
            <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content" id="profileTabsContent">
                    <div class="tab-pane fade show active" id="profile-info" role="tabpanel"
                        aria-labelledby="profile-info-tab">
                        <h2>@lang('lang.personal_information')</h2>
                        <div class="profile-details">
                            <div class="detail">
                                <span class="label">@lang('lang.first name'):</span>
                                <span class="value"><input type="text" name="first_name"
                                        value="{{ $profile['first_name'] }}" class="uneditable" disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.last name'):</span>
                                <span class="value"><input type="text" name="last_name"
                                        value="{{ $profile['last_name'] }}" class="uneditable" disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.email'):</span>
                                <span class="value"><input type="text" name="email" value="{{ $profile['email'] }}"
                                        class="uneditable" disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.phone number'):</span>
                                <span class="value"><input type="text" name="number" value="{{ $profile['number'] }}"
                                        class="uneditable" disabled></span>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="house-location" role="tabpanel" aria-labelledby="house-location-tab">
                        <h2>@lang('lang.your house location')</h2>
                        <div class="house-details">
                            <div class="detail">
                                <span class="label">@lang('lang.location'):</span>
                                <span class="value"><input type="text" name="location" id="location"
                                        value="{{ $profile['one_to_one_swap_house']['location'] }}" class="uneditable"
                                        disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.street'):</span>
                                <span class="value"><input type="text" name="street"
                                        value="{{ $profile['one_to_one_swap_house']['street'] }}" class="uneditable"
                                        disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.post code'):</span>
                                <span class="value"><input type="text" name="post_code"
                                        value="{{ $profile['one_to_one_swap_house']['post_code'] }}" class="uneditable"
                                        disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.house number'):</span>
                                <span class="value"><input type="text" name="house_number"
                                        value="{{ $profile['one_to_one_swap_house']['house_number'] }}"
                                        class="uneditable" disabled></span>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="house-details" role="tabpanel" aria-labelledby="house-details-tab">
                        <h2>@lang('lang.your_house')</h2>
                        <div class="house-images" id="house-images">
                            @foreach ($profile['one_to_one_swap_house']['images'] as $image)
                                <div class="image-container" id="image-container-{{ $image['id'] }}">
                                    <img src="{{ env('MEDIA_BASE_URL') . $image['image_path'] }}" alt="House Image">
                                    <button type="button" class="delete-button"
                                        onclick="deleteImage({{ $image['id'] }})">&times;</button>
                                </div>
                            @endforeach
                        </div>

                        {{-- <div class="slider-container">
                            <div class="slider-wrapper" id="slider-wrapper">
                                @foreach ($profile['one_to_one_swap_house']['images'] as $image)
                                    <div class="slider-item" id="image-container-{{ $image['id'] }}">
                                        <img src="{{ env('MEDIA_BASE_URL') . $image['image_path'] }}" alt="House Image">
                                        <button type="button" class="delete-button"
                                            onclick="deleteImage({{ $image['id'] }})">&times;</button>
                                    </div>
                                @endforeach
                            </div>
                            <button class="slider-arrow slider-arrow-left" id="slider-arrow-left">&#10094;</button>
                            <button class="slider-arrow slider-arrow-right" id="slider-arrow-right">&#10095;</button>
                        </div> --}}
                        <input type="file" name="images[]" class="add-image" id="add-image" multiple>
                        <div class="house-details">
                            <div class="detail">
                                <span class="label">@lang('lang.house type'):</span>
                                <span class="value"><input type="text" name="house_type"
                                        value="{{ $profile['one_to_one_swap_house']['house_type']['type'] }}"
                                        class="uneditable" disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.rent price'):</span>
                                <span class="value"><input type="number" step="0.01" name="price"
                                        value="{{ $profile['one_to_one_swap_house']['price'] }}" class="editable"
                                        disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.number of rooms'):</span>
                                <span class="value"><input type="number" name="number_of_rooms"
                                        value="{{ $profile['one_to_one_swap_house']['number_of_rooms'] }}"
                                        class="editable" disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.area'):</span>
                                <span class="value"><input type="number" step="0.01" name="area"
                                        value="{{ $profile['one_to_one_swap_house']['area'] }}" class="editable"
                                        disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.house_description'):</span>
                                <span class="value">
                                    <textarea name="description" class="editable" disabled style="width: 100%; min-height:15vh;">{{ $profile['one_to_one_swap_house']['description'] }}</textarea>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="your-wishes" role="tabpanel" aria-labelledby="your-wishes-tab">
                        <h2>@lang('lang.your_wishes')</h2>
                        <div class="house-details">
                            <span class="label">@lang('lang.locations of interest'):</span>
                            <input type="text" id="interestsAutocompleteInput"
                                placeholder="Enter a location of interest" style="display:none; width:40%"
                                class="input-field">
                            @foreach ($profile['wishes'] as $wish)
                                <div class="wish-details">
                                    <div class="detail">
                                        <span class="label">@lang('lang.house type'):</span>
                                        <span class="value">
                                            <div class="dropdown">
                                                <input type="text" id="dropdownInput_wish"
                                                    placeholder="@lang('lang.select an option')" readonly class="editable" disabled
                                                    value="{{ old('wish_house_type', $wish['house_type']['type']) }}">
                                                <ul id="dropdownList_wish" class="dropdown-content">
                                                    @foreach ($houseTypes as $type)
                                                        <li data-value="{{ $type['id'] }}">@lang('lang.' . $type['type'])</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <input type="hidden" id="houseType_wish" name="wish_house_type[]"
                                                value="{{ old('wish_house_type', $wish['house_type_id']) }}">
                                        </span>
                                    </div>
                                    <div class="detail">
                                        <span class="label">@lang('lang.max_rent_price'):</span>
                                        <span class="value"><input type="number" step="0.01" name="wish_price"
                                                value="{{ $wish['price'] }}" class="editable" disabled></span>
                                    </div>
                                    <div class="detail">
                                        <span class="label">@lang('lang.min_number_of_rooms'):</span>
                                        <span class="value"><input type="number" name="wish_number_of_rooms"
                                                value="{{ $wish['number_of_rooms'] }}" class="editable" disabled></span>
                                    </div>
                                    <div class="detail">
                                        <span class="label">@lang('lang.min_area'):</span>
                                        <span class="value"><input type="number" step="0.01" name="wish_area"
                                                value="{{ $wish['area'] }}" class="editable" disabled></span>
                                    </div>
                                </div>
                            @endforeach
                            <div class="detail">
                                <div class="tags-container" id="tagsContainer">
                                    @if (isset($profile['intersts']) && !empty($profile['intersts']))
                                        @foreach ($profile['intersts'] as $interest)
                                            <div class="tag">{{ $interest['interest'] }} <span
                                                    data-city={{ $interest['id'] }} class="remove-tag"
                                                    style="display:none">&times;</span></div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="save-button" id="save-button"
                        style="display: none;">@lang('lang.save changes')</button>
                    <button class="delete-account-button" id="delete-account-button"
                        style="display: none;">@lang('lang.delete account')</button>
                </div>
                <input type="hidden" name=delete_interests id="delete_interests" value="">
                <input type="hidden" name=delete_images id="delete_images" value="">
                <input type="hidden" name=interests id="interests" value="">
            </form>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqpFnYM5ToiPcFtSC2SFMo55w3xNgViSQ&libraries=places&callback=initAutocomplete">
    </script>
    <script>
        let initialImagesHTML = '';
        let initialTagsHTML = '';
        let delete_images = [];
        let delete_interests = [];
        let addedTages = [];
        document.querySelectorAll('.remove-tag').forEach(function(removeTag) {
            removeTag.addEventListener('click', function(event) {
                deleteTag(removeTag.getAttribute('data-city'));
            });
        });

        function deleteTag(tagId) {
            if (!delete_interests.includes(tagId)) {
                delete_interests.push(tagId);
            }
            document.getElementById('delete_interests').value = delete_interests;
        }
        document.getElementById('edit-button').addEventListener('click', function() {
            var inputs = document.querySelectorAll('.editable');
            inputs.forEach(function(input) {
                input.disabled = !input.disabled;
            });

            var saveButton = document.getElementById('save-button');
            var addImageInput = document.querySelector('.add-image');
            var interestsAutocompleteInput = document.getElementById('interestsAutocompleteInput');

            if (inputs[0].disabled) {
                saveButton.style.display = 'none';
                addImageInput.style.display = 'none';
                interestsAutocompleteInput.style.display = 'none';
                this.innerText = '@lang('lang.edit')';
                delete_images = [];
                delete_interests = [];
                document.getElementById('delete_images').value = '';
                document.getElementById('delete_interests').value = '';
                document.getElementById('interests').value = '';
                // Restore initial images and tags
                document.getElementById('house-images').innerHTML = initialImagesHTML;
                document.getElementById('tagsContainer').innerHTML = initialTagsHTML;
                attachRemoveTagListeners(); // Reattach listeners to restored tags
            } else {
                saveButton.style.display = 'block';
                addImageInput.style.display = 'block';
                interestsAutocompleteInput.style.display = 'block';
                this.innerText = '@lang('lang.cancel')';

                // Save initial images and tags HTML
                initialImagesHTML = document.getElementById('house-images').innerHTML;
                initialTagsHTML = document.getElementById('tagsContainer').innerHTML;

                // Show delete buttons for images
                var imageContainers = document.querySelectorAll('.image-container');
                imageContainers.forEach(function(container) {
                    container.classList.add('edit-mode');
                });

                // Show delete buttons for tags
                document.querySelectorAll('.remove-tag').forEach(function(removeTag) {
                    removeTag.style.display = 'inline';
                });

                // Attach event listeners to remove tags
                attachRemoveTagListeners();
            }
        });

        document.getElementById('add-image').addEventListener('change', function(event) {
            var files = event.target.files;
            var houseImagesDiv = document.getElementById('house-images');

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var newImageContainer = document.createElement('div');
                    newImageContainer.classList.add('image-container');

                    var newImage = document.createElement('img');
                    newImage.src = e.target.result;
                    newImageContainer.appendChild(newImage);

                    var deleteButton = document.createElement('button');
                    deleteButton.type = 'button';
                    deleteButton.classList.add('delete-button');
                    deleteButton.innerHTML = '&times;';
                    deleteButton.onclick = function() {
                        newImageContainer.remove();
                    };
                    newImageContainer.appendChild(deleteButton);

                    houseImagesDiv.appendChild(newImageContainer);
                }
                reader.readAsDataURL(files[i]);
            }
        });

        function deleteImage(imageId) {
            // Remove the image container from the DOM
            document.getElementById('image-container-' + imageId).remove();
            if (!delete_images.includes(imageId)) {
                delete_images.push(imageId);
            }
            document.getElementById('delete_images').value = delete_images;
        }




        function initAutocomplete() {
            var interestsAutocompleteInput = document.getElementById('interestsAutocompleteInput');
            const tagsContainer = document.getElementById('tagsContainer');


            var interestsAutocomplete = new google.maps.places.Autocomplete(interestsAutocompleteInput, {
                types: ['(cities)'],
                componentRestrictions: {
                    country: "NL"
                }
            });
            interestsAutocomplete.addListener('place_changed', function() {
                var place = interestsAutocomplete.getPlace();
                console.log(place);

                if (!place.place_id) {
                    alert("Please select a place from the dropdown list.");
                    return;
                }

                const cityName = place.name;

                if (!addedTages.includes(cityName)) {
                    addedTages.push(cityName);
                    addTag(cityName);
                }

                interestsAutocompleteInput.value = '';
            });


            var input = document.getElementById('location');


            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['(cities)'],
                componentRestrictions: {
                    country: "NL"
                }
            });

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                console.log(place);

                if (!place.place_id) {
                    alert("Please select a place from the dropdown list.");
                    return;
                }
            });
        }

        function addTag(city) {
            const tagsContainer = document.getElementById('tagsContainer');
            const locationNamesInput = document.getElementById('interests');
            const tag = document.createElement('div');
            tag.className = 'tag';
            tag.innerHTML = `${city} <span class="remove-tag" style="display:inline">&times;</span>`;
            tagsContainer.appendChild(tag);

            tag.querySelector('.remove-tag').addEventListener('click', function(event) {
                event.stopPropagation();
                tag.remove();
            });

            locationNamesInput.value = addedTages.join(',');
        }



        function attachRemoveTagListeners() {
            document.querySelectorAll('.remove-tag').forEach(removeTag => {
                removeTag.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const tag = this.parentElement;
                    tag.remove();
                    document.getElementById('locationNames').value = addedTages.join(',');
                });
            });
        }

        attachRemoveTagListeners();
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    createPreloader();
                });
            }
        });

        // Remove preloader after the page is fully loaded
        window.addEventListener('load', function() {
            removePreloader();
        });
    </script>
@endsection
