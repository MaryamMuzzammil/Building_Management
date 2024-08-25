<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MezzanineFloor extends Model
{
    use HasFactory;
    protected $fillable = [
        'mezzanine_number', 'sq_ft_area', 'tenant_id'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
