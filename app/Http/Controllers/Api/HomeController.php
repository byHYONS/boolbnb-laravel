<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Mail\NewMessage;
use App\Models\Home;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Mail;

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
        try {
            //? trova l'appartamento associato allo slug:
            $home = Home::where('slug', $slug)->first();
    
            if (!$home) {
                return response()->json(['status' => 'failed', 'message' => 'Appartamento non trovato'], 404);
            }
    
           $data = $request->validated();
    
            $message = new Message();
    
            $message->home_id = $home->id;
    
            $message->name = $data['name'];
            $message->email = $data['email'];
            $message->content = $data['content'];
    
            $message->save();

            //? invio email:
            Mail::to('samuele@hyonsre.com')->send(new NewMessage($message));
    
            return response()->json([
                'status' => 'success', 
                'message' => 'Messaggio inviato con successo!'
            ], 201);

        } catch (ValidationException $e) {
            //? erori di validazione:
            return response()->json([
                'status' => 'failed',
                'errors' => $e->errors(), 
            ], 422);
        } catch (Exception $e) {
            //? gestione altri errori:
            return response()->json([
                'status' => 'failed',
                'message' => 'Si è verificato un errore durante l\'invio del messaggio.',
                'error' => $e->getMessage() 
            ], 500);
        }
    }
}
