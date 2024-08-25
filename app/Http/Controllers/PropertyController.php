<?php

// app/Http/Controllers/PropertyController.php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\MezzanineFloor;
use App\Models\Shop;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        // Fetch data from each model
        $flats = Flat::with('tenant')->get();
        $mezzanines = MezzanineFloor::with('tenant')->get();
        $shops = Shop::with('tenant')->get();

        // Pass the data to the view
        return view('properties.index', compact('flats', 'mezzanines', 'shops'));
    }
}

