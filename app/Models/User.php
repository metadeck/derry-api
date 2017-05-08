<?php

namespace App\Models;

use App\Models\App\CardUsage;
use App\Models\App\Review;
use App\Models\WebApp\Elearning\Course;
use App\Models\App\Profile;
use App\Models\WebApp\Elearning\CourseAttempt;
use App\Models\WebApp\Invitation;
use App\Models\WebApp\Team;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Stop mass assignment errors
     *
     * @var array
     */
    protected $guarded = ['is_admin'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'is_admin',
    ];

    /**
     * Calculated attribute for a users full name
     * Accessed via $user->fullName
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * The recorings created by this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recordings()
    {
        return $this->hasMany(Recording::class)->orderBy('created_at', 'DESC');
    }
}
