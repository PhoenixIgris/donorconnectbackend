<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    public function showMap()
    {
        return view('map');
    }

    public function getLocation(Request $request)
    {
        $latitude = $request->input('lat');
        $longitude = $request->input('lon');
        $apiKey = "65f05a78037bd369058252wme7a6478";

        // Validate latitude, longitude, and API key if necessary

        // Make a request to the external API
        $response = Http::get("https://geocode.maps.co/reverse?lat=$latitude&lon=$longitude&api_key=$apiKey");

        // Check if the request was successful
        if ($response->successful()) {
            $data = $response->json();
            // Handle response data as needed
            return response()->json($data);
        } else {
            // Handle unsuccessful response
            return response()->json(['error' => 'Failed to fetch geocode data'], 500);
        }
    }
}
