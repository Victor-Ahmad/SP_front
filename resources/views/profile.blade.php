@extends('layouts.master')

@section('title', 'Profile')

@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <link href="{{ asset('app/css/profile.css') }}?v={{ filemtime(public_path('app/css/profile.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
                                <span class="value">
                                    <div class="dropdown">
                                        <input type="text" id="areaDropdownInput" readonly
                                            placeholder="@lang('lang.select an option')"
                                            value="{{ $profile['one_to_one_swap_house']['area'] }}" class="editable"
                                            disabled>
                                        <ul id="areaDropdownList" class="dropdown-content">
                                            @foreach ($areas as $area)
                                                <li data-value="{{ $area }}">{{ $area }}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <input type="hidden" id="area" name="area"
                                        value="{{ $profile['one_to_one_swap_house']['area'] }}">
                                </span>
                            </div>
                            <div class="detail">
                                <span class="label">@lang('lang.house_description'):</span>
                                <span class="value">
                                    <textarea name="description" class="editable" disabled style="width: 100%; min-height:15vh;">{{ $profile['one_to_one_swap_house']['description'] }}</textarea>
                                </span>
                            </div>
                            <div class="detail">
                                @php
                                    $oldFeatures = old('features', '');
                                    if (!is_array($oldFeatures)) {
                                        $oldFeatures = array_map('trim', explode(',', $oldFeatures));
                                    }
                                @endphp
                                <span class="label">@lang('lang.house features'):</span>
                                <span class="value">
                                    <div class="dropdown">
                                        <input type="text" id="featuresInput" placeholder="@lang('lang.specify house features')"
                                            readonly class="editable" disabled>
                                        <ul id="featuresList" class="multi-select-content">
                                            @foreach ($features as $feature)
                                                <li data-name="{{ $feature['name'] }}" data-value="{{ $feature['id'] }}"
                                                    class="{{ in_array($feature['id'], $oldFeatures) ? 'selected' : '' }}">
                                                    @lang('lang.' . $feature['name'])
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <input type="hidden" id="features" name="features" value="{{ old('features') }}">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="your-wishes" role="tabpanel" aria-labelledby="your-wishes-tab">
                        <h2>@lang('lang.your_wishes')</h2>
                        <div class="house-details">

                            @foreach ($profile['wishes'] as $wish)
                                <div class="wish-details">
                                    <div class="detail">
                                        <span class="label">@lang('lang.house type'):</span>
                                        <span class="value">
                                            <div class="dropdown">
                                                <input type="text" id="dropdownInput_wish"
                                                    placeholder="@lang('lang.select an option')" readonly class="editable" disabled
                                                    value="{{ old('wish_house_type', $wish['house_type']['type'] ?? null) }}">
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
                                        <span class="value">
                                            <div class="dropdown">
                                                <input type="text" id="areaDropdownInput_wish" readonly
                                                    class="editable" disabled placeholder="@lang('lang.select an option')"
                                                    value="{{ old('area_wish', $wish['area']) }}">
                                                <ul id="areaDropdownList_wish" class="dropdown-content">
                                                    @foreach ($areas as $area)
                                                        <li data-value="{{ $area }}">{{ $area }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <input type="hidden" id="area_wish" name="area_wish"
                                                value="{{ old('area_wish') }}">
                                        </span>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                        <div class="detail">
                            @php
                                $oldFeatures_wish = old('features_wish', '');
                                if (!is_array($oldFeatures_wish)) {
                                    $oldFeatures_wish = array_map('trim', explode(',', $oldFeatures_wish));
                                }
                            @endphp
                            <span class="label">@lang('lang.house features'):</span>
                            <span class="value">
                                <div class="dropdown">
                                    <input type="text" id="featuresInput_wish" placeholder="@lang('lang.specify house features')"
                                        readonly class="editable" disabled>
                                    <ul id="featuresList_wish" class="multi-select-content">
                                        @foreach ($features as $feature)
                                            <li data-name="{{ $feature['name'] }}" data-value="{{ $feature['id'] }}"
                                                class="{{ in_array($feature['id'], $oldFeatures_wish) ? 'selected' : '' }}">
                                                @lang('lang.' . $feature['name'])
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <input type="hidden" id="features_wish" name="features_wish"
                                    value="{{ old('features_wish') }}">
                            </span>
                        </div>

                        <div class="detail">
                            <span class="label">@lang('lang.locations of interest'):</span>
                            <span class="value">
                                <input type="text" id="interestsAutocompleteInput"
                                    placeholder="Enter a location of interest" style="display:none;" class="editable"
                                    disabled>
                                <div class="tags-container" id="tagsContainer">
                                    @if (isset($profile['wishes']) && !empty($profile['wishes'][0]['wish_locations']))
                                        @foreach ($profile['wishes'][0]['wish_locations'] as $interest)
                                            <div class="tag">{{ $interest['location'] }} <span
                                                    data-city={{ $interest['id'] }} class="remove-tag"
                                                    style="display:none">&times;</span></div>
                                        @endforeach
                                    @endif
                                </div>
                            </span>
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
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqpFnYM5ToiPcFtSC2SFMo55w3xNgViSQ&libraries=places&callback=initAutocomplete&language=nl">
    </script>
    <script>
        let initialImagesHTML = '';
        let initialTagsHTML = '';
        let delete_images = [];
        let delete_interests = [];
        let addedTages = [];
        document.addEventListener('DOMContentLoaded', function() {


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
                        newImageContainer.classList.add('image                    -container');

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

            // Dropdown setup function
            function setupDropdown(inputId, listId, hiddenInputId) {
                const dropdownInput = document.getElementById(inputId);
                const dropdownList = document.getElementById(listId);
                const dropdownItems = dropdownList.querySelectorAll('li');

                dropdownInput.addEventListener('click', (e) => {
                    e.stopPropagation();
                    dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
                });

                dropdownItems.forEach(item => {
                    item.addEventListener('click', (e) => {
                        const value = e.target.getAttribute('data-value');
                        dropdownList.style.display = 'none';
                        dropdownInput.value = e.target.textContent;
                        document.getElementById(hiddenInputId).value = value;
                    });
                });
            }

            // Call setupDropdown for each dropdown
            setupDropdown('dropdownInput_wish', 'dropdownList_wish', 'houseType_wish');
            setupDropdown('areaDropdownInput_wish', 'areaDropdownList_wish', 'area_wish');
            setupDropdown('areaDropdownInput', 'areaDropdownList', 'area');

            // Close dropdowns when clicking outside
            document.addEventListener('click', (e) => {
                document.querySelectorAll('.dropdown-content').forEach(dropdown => {
                    dropdown.style.display = 'none';
                });
            });
            // Multi-select functionality
            const setupMultiSelect = (inputId, listId, hiddenInputId, profileProperties) => {
                const featuresInput = document.getElementById(inputId);
                const featuresList = document.getElementById(listId);
                const featuresItems = featuresList.querySelectorAll('li');
                let selectedFeatures = [];
                let selectedFeaturesNames = [];

                featuresInput.addEventListener('click', (e) => {
                    e.stopPropagation();
                    featuresList.style.display = featuresList.style.display === 'block' ? 'none' :
                        'block';
                });

                featuresItems.forEach(item => {
                    item.addEventListener('click', (e) => {
                        const value = e.target.getAttribute('data-value');
                        const name = e.target.getAttribute('data-name');
                        if (selectedFeatures.includes(value)) {
                            selectedFeatures = selectedFeatures.filter(feature => feature !==
                                value);
                            selectedFeaturesNames = selectedFeaturesNames.filter(featureName =>
                                featureName !== name);
                            e.target.classList.remove('selected');
                        } else {
                            selectedFeatures.push(value);
                            selectedFeaturesNames.push(name);
                            e.target.classList.add('selected');
                        }
                        featuresInput.value = selectedFeaturesNames.join(', ');
                        document.getElementById(hiddenInputId).value = selectedFeatures.join(
                            ', ');
                    });
                });

                document.addEventListener('click', (e) => {
                    featuresList.style.display = 'none';
                });

                // Auto-select features based on profile data
                if (profileProperties) {
                    profileProperties.forEach(property => {
                        if (property.specific_property) {
                            const featureId = property.specific_property.id.toString();
                            const featureName = property.specific_property.name;
                            const featureItem = [...featuresItems].find(item => item.getAttribute(
                                'data-value') === featureId);
                            if (featureItem) {
                                if (!selectedFeatures.includes(featureId)) {
                                    selectedFeatures.push(featureId);
                                    selectedFeaturesNames.push(featureName);
                                    featureItem.classList.add('selected');
                                }
                            }
                        }
                    });
                    featuresInput.value = selectedFeaturesNames.join(', ');
                    document.getElementById(hiddenInputId).value = selectedFeatures.join(', ');
                }
            };

            // Profile data
            const profile = @json($profile);

            // Setup for one_to_one_swap_house
            if (profile && profile.one_to_one_swap_house && profile.one_to_one_swap_house.specific_properties) {
                setupMultiSelect('featuresInput', 'featuresList', 'features', profile.one_to_one_swap_house
                    .specific_properties);
            }

            // Setup for wishes
            if (profile && profile.wishes && profile.wishes[0] && profile.wishes[0].specific_properties) {
                setupMultiSelect('featuresInput_wish', 'featuresList_wish', 'features_wish', profile.wishes[0]
                    .specific_properties);
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

        }
    </script>


@endsection
