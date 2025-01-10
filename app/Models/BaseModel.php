<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    /**
     * Automatically generate a UUID when creating a new model.
     */
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a UUID for 'id' if not provided
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid()->toString();
            }
        });
    }
}
