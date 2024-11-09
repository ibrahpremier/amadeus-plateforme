<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Budget;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ministere(): BelongsTo
    {
        return $this->belongsTo(Ministere::class);
    }
    public function coordinateur(): BelongsTo
    {
        return $this->belongsTo(Ministere::class);
    }

    /**
     * Liste des reservation faites
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservation(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function isMinistereAgent()
    {
        return $this->role == 'agent_ministere';
    }

    public function isCellAgent()
    {
        return $this->role == 'agent_cellule';
    }

    public function isCellChief()
    {
        return $this->role == 'chef_cellule';
    }

    public function isCoordinator()
    {
        return $this->role == 'coordinateur';
    }

    public function isAdmin()
    {
        return $this->role == 'Administrateur';
    }

    public function getMinistereCurrentBudget()
    {
        return  Budget::where('ministere_id', $this->ministere_id)->latest()->first();
    }
}
