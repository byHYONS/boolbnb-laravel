<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        // $homes = Home::all();

        //? paginazione a 6 elementi con relazione services:
        $homes = Home::with('services', 'user')->paginate(10);

        if ($homes) {
            return response()->json([
                'status' => 'success',
                'results' => $homes
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'results' => null
            ], 404);
        }
    }

    public function show(String $slug)
    {
        //? dettaglio con relazione services:
        $homes = Home::where('slug', $slug)->with('services', 'user','messages')->first();

        if ($homes) {
            return response()->json([
                'status' => 'success',
                'results' => $homes
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'results' => null
            ], 404);
        }
    }
}
