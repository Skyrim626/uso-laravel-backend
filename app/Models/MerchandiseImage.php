<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchandiseImage extends BaseModel
{
     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'merchandise_id',
        'isMain',
        'image_url',
    ];
}
