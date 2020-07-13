<?php namespace App;

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
     * @param Array of string $roles
     * @return A Boolean
     */
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles))
        {
            return true;
        }
        return false;

    }

    /**
     * Show the application dashboard.
     * @author sebastian miranda
     * @param Array of string $roles
     * @return A Boolean
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles))
        {
            foreach ($roles as $role)
            {
                if ($this->hasRole($role))
                {
                    return true;
                }
            }
        } else
        {
            if ($this->hasRole($roles))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Show the application dashboard.
     * @author sebastian miranda
     * @param String $role
     * @return Boolean
     */
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first())
        {
            if($role=="admin")
            {
                return true;
            }
        }
        return false;
    }

}



