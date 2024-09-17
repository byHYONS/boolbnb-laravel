<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Home;
use App\Models\Message;
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

    public function storeMessage(StoreMessageRequest $request, $slug)
    {
        //? trova l'appartamento associato allo slug:
        $home = Home::where('slug', $slug)->first();

        if (!$home) {
            return response()->json(['status' => 'failed', 'message' => 'Appartamento non trovato'], 404);
        }

       $data = $request->validated();

        // Crea e salva il messaggio
        $message = new Message();

        $message->home_id = $home->id;

        $message->name = $data['name'];
        $message->email = $data['email'];
        $message->content = $data['content'];

        $message->save();

        return response()->json([
            'status' => 'success', 
            'message' => 'Messaggio inviato con successo!'
        ], 201);
    }
}
