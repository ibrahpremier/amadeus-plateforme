<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compagnie extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, "compagnie_id");
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, "compagnie_id");
    }
}
