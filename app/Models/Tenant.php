<?php

namespace App\Models;

use App\Models\Rent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory;
    protected $fillable = [
        'tenant_name', 'father_name', 'cnic_number', 'phone_number', 'rent_start_date', 'rent_end_date','home','residence','cnic_image', 'picture', 
    ];

    public function flats()
    {
        return $this->hasMany(Flat::class, 'tenant_id', 'id');
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function mezzanines()
    {
        return $this->hasMany(MezzanineFloor::class);
    }

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }
}
