<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    protected $guard_name = 'web';

    public static function create(array $attributes )
    {
        return static::query()->create($attributes);
    }
    public static function findById(int $id)
    {
        return static::query()->find($id);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  /*  protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];*/
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


    /**
     * Get the rol of a user.
     */
  /*  public function rol(): object
    {
        return $this->belongsTo(Role::class, 'category_id', 'id');
    }
*/

    /**
     * Show the application dashboard.
     * @param array $roles description
     * @return bool
     * @author sebastian miranda
     */
   /* public function authorizeRoles($roles): bool
    {
        return $this->hasAnyRole($roles);

    }*/

    /**
     * Show the application dashboard.
     * @param array/string $roles
     * @return bool
     * @author sebastian miranda
     */
  /*  public function hasAnyRole($roles): bool
    {
        if (is_array($roles)) {

            $hasRoles = collect($roles)->filter(function ($item) {
                return $this->hasRole($item);
            })->count();

            if ($hasRoles) {
                return true;
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
*/
    /**
     * Show the application dashboard.
     * @param string $role
     * @return Boolean
     * @author sebastian miranda
     */
  /*  public function hasRole(string $role): bool
    {
        if ($role == 1) {
            return true;
        }
        return false;
    }
*/

}



