<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GooglePlacesController extends Controller
{
    public function getPlaceDetails(Request $request)
    {
        $placeId = $request->input('placeid');
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        $response = Http::get("https://maps.googleapis.com/maps/api/place/details/json", [
            'placeid' => $placeId,
            'components' => 'NL',
            'key' => $apiKey,

        ]);

        return response()->json($response->json());
    }

    public function searchNearbyCity(Request $request)
    {
        $query = $request->input('query');
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        $response = Http::get("https://maps.googleapis.com/maps/api/place/textsearch/json", [
            'query' => $query,
            'components' => 'NL',
            'key' => $apiKey,
        ]);

        return response()->json($response->json());
    }
}
