<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class GeocodingController extends Controller
{
    // Cambia il tipo di parametro in una stringa, dato che stai passando un indirizzo
    public function getCoordinates(string $address)
    {
        if (!$address) {
            return ['error' => 'Indirizzo non fornito'];
        }

        // Costruisci l'URL per chiamare l'API TomTom
        $apiKey = env('TOMTOM_API_KEY');
        $url = "https://api.tomtom.com/search/2/geocode/" . urlencode($address) . ".json";

        // Fai la richiesta API
        $response = Http::get($url, ['key' => $apiKey]);

        // Gestisci la risposta
        if ($response->successful()) {
            $data = $response->json();

            // Se ci sono coordinate, restituiscile
            if (isset($data['results'][0]['position'])) {
                return $data['results'][0]['position']; // latitudine e longitudine
            } else {
                return ['error' => 'Coordinate non trovate'];
            }
        }

        return ['error' => 'Errore nella chiamata API'];
    }
}