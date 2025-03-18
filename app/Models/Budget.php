<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budget extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function ministere()
    {
        return $this->belongsTo(Ministere::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
