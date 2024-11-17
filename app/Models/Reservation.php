<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Get the agent_ministere qui à emit reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent_ministere(): BelongsTo
    {
        return $this->belongsTo(User::class, 'charge_de_mission_id');
    }

    public function ministere () :Attribute{
        return Attribute::make(
            get: fn() => $this->agent_ministere?->ministere
        );
    }

    /**
     * Get the chef_cellule qui traite la reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chef_cellule(): BelongsTo
    {
        return $this->belongsTo(User::class, 'chef_cellule_id');
    }

    /**
     * Get the agent_cellule qui traite la reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent_cellule(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_cellule_id');
    }

    /**
     * Get the agent_cellule qui traite la reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
