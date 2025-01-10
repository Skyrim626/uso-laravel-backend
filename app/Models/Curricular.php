<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curricular extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'logo_url',
        'is_noncurricular',
    ];
}
