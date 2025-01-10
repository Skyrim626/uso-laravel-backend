<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
   
    use HasFactory, Notifiable, HasApiTokens;

    protected $keyType = 'string'; // Ensure the id is treated as a string (UUID)
    public $incrementing = false;  // Disable auto-incrementing for UUIDs

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'course_id',
        'student_id',
        'username',
        'year',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'gender',
        'phone_number',
        'password',
        'date_of_birth',
        'address',
        'facebook_link_url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
     * Summary of course: Each user belongs to a course
     * @return \App\Models\BelongsTo
     */
    public function course(): BelongsTo {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Summary of organizations: Each user belongs to many organizations
     * @return BelongsToMany
     */
    public function organizations(): BelongsToMany {
        return $this->belongsToMany(Organization::class, 'organization_members', 'member_id', 'organization_id')->withPivot('status')->withTimestamps();
    }

    /**
     * Summary of hasRole: Check if the user has this role.
     * @param string $roleName
     * @return bool
     */
    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Summary of hasRoles: Check if the user has these roles.
     * @param array $roleNames
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hasRoles(array $roleNames = []): BelongsToMany {
        return $this->roles()->whereIn('name', $roleNames);
    }

      /**
       * Summary of roles: Each user has one or more roles
       * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
       */
      public function roles(): BelongsToMany
      {
          return $this->belongsToMany(Role::class, table: 'user_roles');
      }
}
