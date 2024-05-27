<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function Laravel\Prompts\error;

class GooglePlacesController extends Controller
{

    public function getPlaceDetails(Request $request)
    {

        $placeId = $request->input('place_id');
        $apiKey =  env('GOOGLE_MAPS_API_KEY');
        $url = "https://maps.googleapis.com/maps/api/place/details/json?place_id={$placeId}&key={$apiKey}";
        $response = Http::get($url);
        $data = $response->json();

        if ($data['status'] === 'OK' && !empty($data['result'])) {


            $street = '';
            foreach ($data['result']['address_components'] as $component) {
                if (in_array('route', $component['types'])) {
                    $street = $component['long_name'];
                    break;
                }
            }

            return response()->json(['street' => $street]);
        }

        return response()->json(['error' => 'Failed to fetch place details'], 400);
    }
    public function getPlaceDetailsByCoords(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $apiKey =  env('GOOGLE_MAPS_API_KEY');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lng}&key={$apiKey}";

        $response = Http::get($url);
        $data = $response->json();

        if ($data['status'] === 'OK' && !empty($data['results'])) {
            $street = '';
            foreach ($data['results'][0]['address_components'] as $component) {
                if (in_array('route', $component['types'])) {
                    $street = $component['long_name'];
                    break;
                }
            }

            return response()->json(['street' => $street]);
        }

        return response()->json(['error' => 'Failed to fetch place details'], 400);
    }
}
