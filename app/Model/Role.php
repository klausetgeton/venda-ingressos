<?php

namespace App\Model;


class Role extends \Bican\Roles\Models\Role
{


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
        return $this->belongsToMany('Bican\Roles\Models\Permission', 'permission_role')->withTimestamps();
    }

}