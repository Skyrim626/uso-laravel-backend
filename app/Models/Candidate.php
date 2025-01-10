<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'position_id',
        'user_id',
        'photo_url',
        'cor_url',
        'grades_url',
        'moral_url',
        'certificate_url',
        'pds_url',
        'facebook_link',
    ];
    
    /**
     * Summary of position: Each candidate belongs to a position.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position() {
        return $this->belongsTo(Position::class, 'position_id');
    }

    /**
     * Summary of user: Each candidate belong to a user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
