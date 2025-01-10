<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'id',
      'name'
    ];

    //
    public function user() {
        return $this->belongsToMany(User::class, 'user_roles');
    }

    public function users(): BelongsToMany {
      return $this->belongsToMany(User::class, 'user_roles');
    }
}
