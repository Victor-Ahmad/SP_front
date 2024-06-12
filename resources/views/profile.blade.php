@extends('layouts.master')

@section('title', 'Profile')

@section('head_css')

    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <link href="{{ asset('app/css/profile.css') }}?v={{ filemtime(public_path('app/css/profile.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                        <span class="label">@lang('lang.house type'):</span>
                        <span class="value"><input type="text" name="house_type"
                                value="{{ $profile['one_to_one_swap_house']['house_type']['type'] }}" class="uneditable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">@lang('lang.location'):</span>
                        <span class="value"><input type="text" name="location" id ="location"
                                value="{{ $profile['one_to_one_swap_house']['location'] }}" class="uneditable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">@lang('lang.post code'):</span>
                        <span class="value"><input type="text" name="post_code"
                                value="{{ $profile['one_to_one_swap_house']['post_code'] }}" class="uneditable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">@lang('lang.street'):</span>
                        <span class="value"><input type="text" name="street"
                                value="{{ $profile['one_to_one_swap_house']['street'] }}" class="uneditable"
                                disabled></span>
                    </div>
                    <div class="detail">
                        <span class="label">@lang('lang.house number'):</span>
                        <span class="value"><input type="text" name="house_number"
                                value="{{ $profile['one_to_one_swap_house']['house_number'] }}" class="uneditable"
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
                    <div class="detail">
                        <span class="label">@lang('lang.house features'):</span>
                        <span class="value">
                            <div class="multi-select">
                                <input type="text" id="featuresInput" readonly class="editable" disabled>
                                <ul id="featuresList" class="multi-select-content">
                                    @foreach ($features as $feature)
                                        <li data-name="{{ $feature['name'] }}" data-value="{{ $feature['id'] }}"
                                            class="{{ in_array($feature['id'], array_column($profile['one_to_one_swap_house']['specific_properties'], 'property_id')) ? 'selected' : '' }}">
                                            {{ $feature['name'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <input type="hidden" id="features\"
                                name="features[]"
                                value="{{ implode(',', array_column($profile['one_to_one_swap_house']['specific_properties'], 'property_id')) }}">
                        </span>
                    </div>
                    <div class="detail">
                        <span class="label">@lang('lang.house description'):</span>
                        <span class="value">
                            <textarea name="description" class="editable" disabled style="width: 25vw; min-height:15vh;">{{ $profile['one_to_one_swap_house']['description'] }}</textarea>
                        </span>
                    </div>

                </div>

                <h2>@lang('lang.your wishes')</h2>
                <div class="house-details">
                    <span class="label">@lang('lang.locations of interest'):</span>
                    <input type="text" id="interestsAutocompleteInput" placeholder="Enter a location of interest"
                        style="display:none; width:40%" class="input-field">
                    <div class="detail">
                        <div class="tags-container" id="tagsContainer">
                            @if (isset($profile['intersts']) && !empty($profile['intersts']))
                                @foreach ($profile['intersts'] as $interest)
                                    <div class=tag>{{ $interest['interest'] }} <span data-city={{ $interest['id'] }}
                                            class="remove-tag" style="display:none">&times;</span></div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                    @foreach ($profile['wishes'] as $wish)
                        <div class="wish-details">
                            <div class="detail">
                                <span class="label">@lang('lang.house type'):</span>
                                <span class="value">
                                    <div class="dropdown">
                                        <input type="text" id="dropdownInput_wish" placeholder="@lang('lang.select an option')"
                                            readonly class="editable" disabled
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
                                <span class="label">@lang('lang.min number of rooms'):</span>
                                <span class="value"><input type="number" name="wish_number_of_rooms"
                                        value="{{ $wish['number_of_rooms'] }}" class="editable" disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.max rent price'):</span>
                                <span class="value"><input type="number" step="0.01" name="wish_price"
                                        value="{{ $wish['price'] }}" class="editable" disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.area'):</span>
                                <span class="value"><input type="number" step="0.01" name="wish_area"
                                        value="{{ $wish['area'] }}" class="editable" disabled></span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.house features'):</span>
                                <span class="value">
                                    <div class="multi-select">
                                        <input type="text" id="featuresInput_wish" readonly class="editable" disabled>
                                        <ul id="featuresList_wish" class="multi-select-content">
                                            @foreach ($features as $feature)
                                                <li data-name="{{ $feature['name'] }}" data-value="{{ $feature['id'] }}"
                                                    class="{{ in_array($feature['id'], array_column($wish['specific_properties'], 'property_id')) ? 'selected' : '' }}">
                                                    {{ $feature['name'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <input type="hidden" id="features_wish" name="features_wish[]"
                                        value="{{ implode(',', array_column($wish['specific_properties'], 'property_id')) }}">
                                </span>
                            </div>
                        </div>
                    @endforeach


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
                <button class="delete-account-button" id="delete-account-button"
                    style="display: none;">@lang('lang.delete account')</button>
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
            var deleteAccountButton = document.getElementById('delete-account-button');
            var addImageInput = document.querySelector('.add-image');
            var interestsAutocompleteInput = document.getElementById('interestsAutocompleteInput');

            if (inputs[0].disabled) {
                saveButton.style.display = 'none';
                // deleteAccountButton.style.display = 'none';
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
                // deleteAccountButton.style.display = 'block';
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
        // Multi-select functionality for house features
        document.addEventListener('DOMContentLoaded', () => {
            const featuresInput = document.getElementById('featuresInput');
            const featuresList = document.getElementById('featuresList');
            const featuresItems = featuresList.querySelectorAll('li');
            let selectedFeatures = [];
            let selectedFeaturesNames = [];

            // Initialize selected features from profile data
            selectedFeatures = {!! json_encode(array_column($profile['one_to_one_swap_house']['specific_properties'], 'property_id')) !!};
            selectedFeaturesNames = selectedFeatures.map(value => {
                const item = featuresList.querySelector(`li[data-value="${value}"]`);
                if (item) {
                    item.classList.add('selected');
                    return item.getAttribute('data-name');
                }
                return '';
            }).filter(name => name !== '');
            featuresInput.value = selectedFeaturesNames.join(', ');

            featuresInput.addEventListener('click', (e) => {
                e.stopPropagation();
                featuresList.style.display = featuresList.style.display === 'block' ? 'none' : 'block';
            });

            featuresItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    const value = e.target.getAttribute('data-value');
                    const name = e.target.getAttribute('data-name');
                    if (selectedFeatures.includes(value)) {
                        selectedFeatures = selectedFeatures.filter(feature => feature !== value);
                        selectedFeaturesNames = selectedFeaturesNames.filter(featureName =>
                            featureName !==
                            name);
                        e.target.classList.remove('selected');
                    } else {
                        selectedFeatures.push(value);
                        selectedFeaturesNames.push(name);
                        e.target.classList.add('selected');
                    }
                    featuresInput.value = selectedFeaturesNames.join(', ');
                    document.getElementById('features').value = selectedFeatures.join(',');
                    alert(selectedFeatures.join(','));
                });
            });

            document.addEventListener('click', (e) => {
                featuresList.style.display = 'none';
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            @foreach ($profile['wishes'] as $wish)
                const featuresInputWish{{ $loop->index }} = document.getElementById(
                    'featuresInput_wish');
                const featuresListWish{{ $loop->index }} = document.getElementById(
                    'featuresList_wish');
                const featuresItemsWish{{ $loop->index }} = featuresListWish{{ $loop->index }}.querySelectorAll(
                    'li');
                let selectedFeaturesWish{{ $loop->index }} = [];
                let selectedFeaturesNamesWish{{ $loop->index }} = [];

                // Initialize selected features from the wish
                selectedFeaturesWish{{ $loop->index }} = {!! json_encode(array_column($wish['specific_properties'], 'property_id')) !!};
                selectedFeaturesNamesWish{{ $loop->index }} = selectedFeaturesWish{{ $loop->index }}.map(
                    value => {
                        const item = featuresListWish{{ $loop->index }}.querySelector(
                            `li[data-value="${value}"]`);
                        if (item) {
                            item.classList.add('selected');
                            return item.getAttribute('data-name');
                        }
                        return '';
                    }).filter(name => name !== '');
                featuresInputWish{{ $loop->index }}.value = selectedFeaturesNamesWish{{ $loop->index }}.join(
                    ', ');

                featuresInputWish{{ $loop->index }}.addEventListener('click', (e) => {
                    e.stopPropagation();
                    featuresListWish{{ $loop->index }}.style.display =
                        featuresListWish{{ $loop->index }}.style.display === 'block' ? 'none' : 'block';
                });

                featuresItemsWish{{ $loop->index }}.forEach(item => {
                    item.addEventListener('click', (e) => {
                        const value = e.target.getAttribute('data-value');
                        const name = e.target.getAttribute('data-name');
                        if (selectedFeaturesWish{{ $loop->index }}.includes(value)) {
                            selectedFeaturesWish{{ $loop->index }} =
                                selectedFeaturesWish{{ $loop->index }}.filter(feature =>
                                    feature !== value);
                            selectedFeaturesNamesWish{{ $loop->index }} =
                                selectedFeaturesNamesWish{{ $loop->index }}.filter(featureName =>
                                    featureName !== name);
                            e.target.classList.remove('selected');
                        } else {
                            selectedFeaturesWish{{ $loop->index }}.push(value);
                            selectedFeaturesNamesWish{{ $loop->index }}.push(name);
                            e.target.classList.add('selected');
                        }
                        featuresInputWish{{ $loop->index }}.value =
                            selectedFeaturesNamesWish{{ $loop->index }}.join(', ');
                        document.getElementById('features_wish').value =
                            selectedFeaturesWish{{ $loop->index }}.join(',');
                    });
                });

                document.addEventListener('click', () => {
                    featuresListWish{{ $loop->index }}.style.display = 'none';
                });
            @endforeach
        });




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
        document.getElementById('delete-account-button').addEventListener('click', function() {
            if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                $.ajax({
                    url: '{{ route('deleteAccount') }}', // Ensure you have a route for this
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect;
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },


                });
            }
        });
    </script>

@endsection
