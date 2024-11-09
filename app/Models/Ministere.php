<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministere extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function budgets()
    {
        return $this->hasMany(Budget::class, 'ministere_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'reservation_id');
    }

}
