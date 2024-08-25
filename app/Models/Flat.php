<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;
    protected $fillable = [
        'flat_number', 'floor_number', 'total_rooms', 'sq_ft_area', 'tenant_id'
    ];



    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
