<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends BaseModel
{
    use SoftDeletes;

    protected $keyType = 'string'; // Ensure the id is treated as a string (UUID)
    public $incrementing = false;  // Disable auto-incrementing for UUIDs

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'curricular_id',
        'officer_id',
        'name',
        'address',
        'phone_number',
        'email',
        'logo_url',
    ];

    /**
     * Summary of users: Each organization belongs to many users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'organization_members', 'organization_id', 'member_id')
                    ->withPivot('status') // Track the status
                    ->withTimestamps();  // Track when the status changed
    }
}
