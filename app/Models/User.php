<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    const DEACTIVE = 0;
    const ACTIVE = 1;
    const DEFAULT_PASSWORD = 12345678;

    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid', 
        'user_name', 
        'first_name', 
        'last_name', 
        'avatar', 
        'email', 
        'password', 
        'address', 
        'birthday', 
        'phone',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function isAdmin()
    {
        return $this->hasRole(config('access.role.admin_role'));
    }

    public function isStaff()
    {
        return $this->hasRole(config('access.role.staff_role'));
    }

    public function isActive()
    {
        return $this->where('active', self::ACTIVE);
    }
}
