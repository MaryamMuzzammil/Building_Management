<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    protected $table = 'rent';
    protected $fillable = [
        'tenant_id', 'rent_for_month', 'month', 'date', 'paid_rent','total_month','total_amount','year','multiple_month','government_taxes','all_total'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
