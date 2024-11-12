<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agence extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, "agence_id");
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, "agence_id");
    }
}
