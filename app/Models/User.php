<?php

namespace App\Models;

use App\Models\backend\AuthorizeCustomer;
use App\Models\backend\Profile;
use App\Models\backend\userHasSkills;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function profile(){
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }
    public function skills(){
        return $this->hasOne(userHasSkills::class, 'user_id', 'id');
    }

    public function authCutomer(){
        return $this->hasOne(AuthorizeCustomer::class, 'user_id', 'id');
    }

}
