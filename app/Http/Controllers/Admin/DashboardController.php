<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use App\Models\Visual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $homes = Home::where('user_id', Auth::id())->get();
        $homeId = [];

        foreach ($homes as $home) {
            array_push($homeId, $home['id']);
        }

        $visitors = Visual::whereIn('home_id', $homeId)->get();
        return view('admin.dashboard', compact('visitors'));
    }
}
