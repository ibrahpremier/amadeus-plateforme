<?php

namespace App\Models;

use App\Models\Agence;
use App\Models\Budget;
use App\Models\Compagnie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *  agent ministere qui à emit le ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent_ministere(): BelongsTo
    {
        return $this->belongsTo(User::class, 'charge_de_mission_id');
    }

    /**
     * Get the agent cellule qui à traité le ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent_cellule(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_cellule_id');
    }

    /**
     * Get the reservation relatif a ce ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class, 'agence_id');
    }

    public function compagnie()
    {
        return $this->belongsTo(Compagnie::class, 'compagnie_id');
    }

    public function calculateTotalCost()
    {
        $basePrice = $this->prix;
        $commission = 0;

        // dd($this);
        if($this->classe) {
        switch($this->classe) {
            case 'economique':
                $commission = $this->agence->marge_eco;
                break;
            case 'business':
                $commission = $this->agence->marge_affaire;
                break;
            case 'first':
                $commission = $this->agence->marge_first;
                break;
            case 'jet':
                $commission = $this->agence->marge_jet;
                break;
            }
        } else {
            $commission = 0;
        }
        // dd($this, $basePrice, $commission);
        return $basePrice + $commission;
    }
}
