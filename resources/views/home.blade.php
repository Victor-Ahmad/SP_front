@extends('layouts.master')

@section('title', 'Home Page')
@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
@endsection

@section('content')
    <div id="pagee" class="clearfix">
        @include('layouts.partial.home.grid_posts', ['posts' => $posts])
    </div>
@endsection



@section('additional_scripts')
    <script>
        $(document).ready(function() {
            $('.nice-select').on('click', '.option', function() {
                var value = $(this).data('value');
                $(this).closest('.nice-select').find('input[type="hidden"]').val(value);
            });
        });

        $(document).ready(function() {
            $('.noUi-handle').on('click', function() {
                $(this).width(50);
            });
            var minValue = parseInt('{{ request('min_value', 100) }}', 10);
            var maxValue = parseInt('{{ request('max_value', 2000) }}', 10);
            var rangeSlider = document.getElementById('slider-range');
            var moneyFormat = wNumb({
                decimals: 0,
                thousand: ',',
                prefix: '€'
            });
            noUiSlider.create(rangeSlider, {
                start: [minValue, maxValue],
                step: 1,
                range: {
                    'min': [100],
                    'max': [2000]
                },
                format: moneyFormat,
                connect: true
            });
            // Set visual min and max values and also update value hidden form inputs
            rangeSlider.noUiSlider.on('update', function(values, handle) {
                document.getElementById('slider-range-value1').innerHTML = values[0];
                document.getElementById('slider-range-value2').innerHTML = values[1];
                document.getElementById('min_value').value = moneyFormat.from(values[0]);
                document.getElementById('max_value').value = moneyFormat.from(values[1]);
            });
        });
    </script>
@endsection
