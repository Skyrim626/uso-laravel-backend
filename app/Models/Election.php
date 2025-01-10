<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Election extends BaseModel
{
    protected $keyType = 'string'; // Ensure the id is treated as a string (UUID)
    public $incrementing = false;  // Disable auto-incrementing for UUIDs

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'organization_id',
        'title',
        'description',
        'image_url',
        'start_date',
        'end_date',
    ];

    
    /**
     * Summary of organization: Each election belongs to an organization.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization(): BelongsTo {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
