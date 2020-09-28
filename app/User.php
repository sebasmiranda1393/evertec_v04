<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }

    /**
     * Show the application dashboard.
     * @author sebastian miranda
     * @param array $roles description
     * @return bool
     */
    public function  authorizeRoles($roles): bool
    {
      return $this->hasAnyRole($roles);

    }

    /**
     * Show the application dashboard.
     * @author sebastian miranda
     * @param array/string $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {

            $hasRoles = collect($roles)->filter(function ($item){
                return $this->hasRole($item);
            })->count();

            if ($hasRoles){
            return true;
            }
        } else {
            if ($this->hasRole($roles))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Show the application dashboard.
     * @param string $role
     * @return Boolean
     * @author sebastian miranda
     */
    public function hasRole(string $role): bool
    {
        if ($this->roles()->where('name', $role)->first())
        {
            if($role=='admin')
            {
                return true;
            }
        }
        return false;
    }

}



