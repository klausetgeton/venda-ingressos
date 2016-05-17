<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Bican\Roles\Models\Permission;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

use OwenIt\Auditing\AuditingTrait;

class User extends Model implements AuthenticatableContract,                                    
                                    CanResetPasswordContract,
                                    HasRoleAndPermissionContract
{    
    use Authenticatable,  CanResetPassword, HasRoleAndPermission;

    use AuditingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'rg', 'cpf'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


     /**
     * The roles that belong to the role.
     */
    public function getP()
    {
        return $this->belongsToMany('Bican\Roles\Models\Permission')->get();
    }

     /**
     * The Permission that belong to this user.
     */
    public function hasThisP($p)
    {
        foreach ($this->belongsToMany('Bican\Roles\Models\Permission')->get() as $perm) 
        {
            if($perm->id == $p)
            {
                return true;
            }
        }      
        return false;  
    }


    public function perm()
    {
        return $this->belongsToMany('Bican\Roles\Models\Permission', 'permission_user')->withTimestamps();
    }
}
