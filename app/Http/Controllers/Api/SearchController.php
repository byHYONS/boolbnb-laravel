<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Home;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $city = $request->input('city');

        //* Metodo Haversine:
        // //? distanza di default 20 km:
        // $distance = $request->input('distance', 20); 

        //* T_Distance_Sphere:
        // //? distanza di default 20 km:
        $distance = $request->input('distance', 20000);

        //? validazione input:
        $validator = Validator::make($request->all(), [
            'city' => 'required|string|max:255',
            'distance' => 'numeric|min:1|max:100000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        //? richiamiamo la funzione per prendere le coordinate dell'indirizzo inserito:
        $coordinates = $this->getCoordinatesFromCity($city);

        if (!$coordinates) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Impossibile trovare le coordinate per la città specificata.',
            ], 404);
        }

        $latitude = $coordinates['latitude'];
        $longitude = $coordinates['longitude'];

        //* Metodo Haversine:
        //? query su db per trovare le case entro la distanza specificata * formula per calcolare le case da prendere:
        // $homes = Home::selectRaw("
        //         *, ( 6371 * acos( cos( radians(?) ) * cos( radians(lat) )
        //         * cos( radians(`long`) - radians(?) ) + sin( radians(?) )
        //         * sin( radians(lat) ) ) ) AS distance
        //     ", [$latitude, $longitude, $latitude])
        //     ->having('distance', '<=', $distance)
        //     ->orderBy('distance')
        //     //? icluiamo nei risultati le relazioni:
        //     ->with('services', 'user')
        //     ->limit(12)
        //     ->get();

        //* T_Distance_Sphere:
        $homes = Home::selectRaw("
            homes.*, 
            ST_Distance_Sphere(
                POINT(homes.long, homes.lat),  -- Il punto lat/long del record nella tabella `homes`
                POINT(?, ?)                    -- Le coordinate di latitudine e longitudine dell'utente
            ) AS distance,
            (CASE 
                WHEN ad_home.home_id IS NOT NULL THEN 1  -- Verifica se l'appartamento è sponsorizzato
                ELSE 0
            END) AS is_sponsored
        ", [$longitude, $latitude])
        ->leftJoin('ad_home', 'homes.id', '=', 'ad_home.home_id')  // Verifica se esiste una sponsorizzazione
        ->having('distance', '<=', $distance)
        ->orderBy('is_sponsored', 'DESC')  // Prima gli appartamenti sponsorizzati
        ->orderBy('distance')  // Poi ordina per distanza
        ->with('services', 'user')  // Includi le relazioni con servizi e utenti
        ->limit(12)
        ->get();

        // Se non ci sono risultati:
        if ($homes->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'results' => [],
            ]);
        }

        // Restituisci i risultati:
        return response()->json([
            'status' => 'success',
            'results' => $homes,
        ]);

    }

    //* metodo per la chiamata API tomtom:
    private function getCoordinatesFromCity($city)
    {
        $apiKey = env('TOMTOM_API_KEY');
        $url = 'https://api.tomtom.com/search/2/search/' . urlencode($city) . '.json';

        $response = Http::withOptions([
            //? Disabilita la verifica del certificato SSL:
            'verify' => false
        ])->get($url, [
            'key' => $apiKey,
            'limit' => 1
        ]);


        if ($response->successful()) {
            $data = $response->json();

            if (!empty($data['results'])) {
                $position = $data['results'][0]['position'];
                return [
                    'latitude' => $position['lat'],
                    'longitude' => $position['lon'],
                ];
            }
        }

        return null;
    }


    // //* OPZIONALE: metodo per l'autocompilatore -> suggeritore:
    public function autocomplete(Request $request)
    {
        $query = $request->input('query');
        //? distanza di default 20 km:
        $distance = $request->input('distance', 20);

        if (!$query) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Query è richiesta.',
            ], 400);
        }

        //? richiamiamo la funzione per prendere le coordinate dell'indirizzo inserito:
        $coordinates = $this->getCoordinatesFromCity($query);

        if (!$coordinates) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Impossibile trovare le coordinate per l\'indirizzo specificato.',
            ], 404);
        }

        $latitude = $coordinates['latitude'];
        $longitude = $coordinates['longitude'];

        //? query su db per ricerca parziale sugli indirizzi delle case entro la distanza specificata * formula per calcolare le case da prendere:
        $homes = Home::selectRaw("
            *, ( 6371 * acos( cos( radians(?) ) * cos( radians(lat) )
            * cos( radians(`long`) - radians(?) ) + sin( radians(?) )
            * sin( radians(lat) ) ) ) AS distance
        ", [$latitude, $longitude, $latitude])
            ->having('distance', '<=', $distance)
            ->where('address', 'like', $query . '%')
            //? includiamo relazioni:
            ->with('services', 'user')
            //? limite del numero di risultati restituiti:
            ->limit(10)
            ->get();

        return response()->json([
            'status' => 'success',
            'results' => $homes,
        ]);
    }
}
