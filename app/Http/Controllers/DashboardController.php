<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Rent;
use App\Models\Shop;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\MezzanineFloor;
use Illuminate\Foundation\Auth\User;

class DashboardController extends Controller
{
    public function index()
    {
      
      
        $totalTenants = Tenant::count();
        $totalFloors = Shop::count(); 
        $totalFlats = Flat::count();
        $totalRent = Rent::sum('rent_for_month');

        return view('dashboard', compact('totalTenants', 'totalFloors', 'totalFlats', 'totalRent'));
    }
}
