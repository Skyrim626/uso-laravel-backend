<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchandise extends BaseModel
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
        'organization_id',
        'category_id',
        'name',
        'description',
        'size',
        'color',
        'price',
        'quantity',
    ];

    /**
     * Summary of organization: Each merchandise belongs to an organization.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization(): BelongsTo {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    /**
     * Summary of images: Each merchandise has many images
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany {
        return $this->hasMany(MerchandiseImage::class, 'merchandise_id');
    }

    /**
     * Summary of category: Each merchandse belongs to a category.
     * @return BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
