<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{   

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'election_id',
        'max_candidates',
    ];

    /**
     * Summary of candidates: Each position has many candidates.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function candidates(): HasMany {
        return $this->hasMany(Candidate::class, 'position_id');
    }
}
