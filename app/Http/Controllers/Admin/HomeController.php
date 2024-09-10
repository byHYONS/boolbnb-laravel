<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;
use App\Models\Home;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Home::all();

        return view('admin.homes.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.homes.create', compact('services')); //compact('services')
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHomeRequest $request)
    {
        $data = $request->validated();

        $img_path = $request->file('image')->store('uploads');

        $apartment = new Home();
        $apartment->title = $data['title'];
        $apartment->slug = Str::of($data['title'])->slug();
        $apartment->description = $data['description'];
        $apartment->beds = $data['beds'];
        $apartment->bathrooms = $data['bathrooms'];
        $apartment->rooms = $data['rooms'];
        $apartment->square_metres = $data['square_metres'];
        $apartment->address = $data['address'];
        $apartment->lat = "lat";
        $apartment->long = "long";
        $apartment->active = $data['active'];
        $apartment->user_id = Auth::user()->id;
        $apartment->image = $img_path;

        $apartment->save();
        if ($request->has('services')) {
            $apartment->services()->attach($request->service);
        }
        return redirect()->route('admin.homes.index')->with('message', 'creazione avvenuta con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $apartment = Home::find($id);
        $services = Service::all();
        return view('admin.homes.show', compact('apartment', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        $services = Service::all();
        return view('admin.homes.edit', compact('services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeRequest $request, Home $apartment)
    {
        $data = $request->validated();

        $img_path = $request->file('image')->store('uploads');

        $apartment->title = $data['title'];
        $apartment->slug = Str::of($data['title'])->slug();
        $apartment->description = $data['description'];
        $apartment->beds = $data['beds'];
        $apartment->bathrooms = $data['bathrooms'];
        $apartment->rooms = $data['rooms'];
        $apartment->square_metres = $data['square_metres'];
        $apartment->address = $data['address'];
        $apartment->lat = "lat";
        $apartment->long = "long";
        $apartment->active = $data['active'];
        $apartment->user_id = Auth::user()->id;
        $apartment->image = $img_path;

        $apartment->update($data);

        $apartment->save();

        if ($request->has('services')) {

            $apartment->services()->sync($request->services);
        } else {
            $apartment->services()->detach();
        }
        return redirect()->route('admin.homes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $apartment)
    {
        $apartment->services()->detach();

        if ($apartment->image) {
            Storage::delete($apartment->image);
        }

        $apartment->delete();
        return redirect()->route('admin.home.index');
    }
}
