@extends('layouts.master')

@section('title', 'Profile')

@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <link href="{{ asset('app/css/profile.css') }}?v={{ filemtime(public_path('app/css/profile.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
@endsection

@section('content')
    <div id="pagee" class="clearfix">
        <div class="profile-container">
            <div class="profile-header">
                <img src="https://via.placeholder.com/100" alt="Profile Picture">
                <div class="name">{{ $profile['first_name'] }} {{ $profile['last_name'] }}</div>
                <button class="edit-button" id="edit-button">Edit</button>
            </div>

            <h2>@lang('lang.profile information')</h2>
            <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @method('PATCH') --}}
                <div class="profile-details">
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

                <h2>@lang('lang.house details')</h2>
                <div class="house-details">
                    <div class="detail">
                        <span class="label">@lang('lang.location'):</span>
                        <span class="value"><input type="text" name="location"
                                value="{{ $profile['one_to_one_swap_house']['location'] }}" class="editable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">@lang('lang.post code'):</span>
                        <span class="value"><input type="text" name="post_code"
                                value="{{ $profile['one_to_one_swap_house']['post_code'] }}" class="editable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">@lang('lang.street'):</span>
                        <span class="value"><input type="text" name="street"
                                value="{{ $profile['one_to_one_swap_house']['street'] }}" class="editable" disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">@lang('lang.house number'):</span>
                        <span class="value"><input type="text" name="house_number"
                                value="{{ $profile['one_to_one_swap_house']['house_number'] }}" class="editable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">@lang('lang.number of rooms'):</span>
                        <span class="value"><input type="number" name="number_of_rooms"
                                value="{{ $profile['one_to_one_swap_house']['number_of_rooms'] }}" class="editable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">@lang('lang.rent price'):</span>
                        <span class="value"><input type="number" step="0.01" name="price"
                                value="{{ $profile['one_to_one_swap_house']['price'] }}" class="editable" disabled></span>
                    </div>
                </div>

                <h2>@lang('lang.interests')</h2>
                <div class="house-details">
                    <input type="text" id="interestsAutocompleteInput" placeholder="Enter a location of interest"
                        style="display:none; width:40%" class="input-field">
                    <div class="detail">

                        <div class="tags-container" id="tagsContainer">
                            @foreach ($profile['intersts'] as $interest)
                                <div class=tag>{{ $interest['interest'] }} <span data-city={{ $interest['id'] }}
                                        class="remove-tag" style="display:none">&times;</span></div>
                            @endforeach
                        </div>

                    </div>

                </div>
                <h2>@lang('lang.house images')</h2>
                <div class="house-images" id="house-images">
                    @foreach ($profile['one_to_one_swap_house']['images'] as $image)
                        <div class="image-container" id="image-container-{{ $image['id'] }}">
                            <img src="{{ env('MEDIA_BASE_URL') . $image['image_path'] }}" alt="House Image">
                            <button type="button" class="delete-button"
                                onclick="deleteImage({{ $image['id'] }})">&times;</button>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name=delete_interests id="delete_interests" value="">
                <input type="hidden" name=delete_images id="delete_images" value="">
                <input type="hidden" name=interests id="interests" value="">
                <input type="file" name="images[]" class="add-image" id="add-image" multiple>

                <button type="submit" class="save-button" id="save-button"
                    style="display: none;">@lang('lang.save changes')</button>
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
    </script>
@endsection
