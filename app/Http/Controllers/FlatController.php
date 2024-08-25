<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function show($id)
    {
        $flat = Flat::findOrFail($id);
        return view('show', compact('flats'));
    }
    public function showByFlatNumber($flatNumber)
    {
        $flat = Flat::where('flat_number', $flatNumber)->firstOrFail();
        return response()->json($flat);
    }
}
