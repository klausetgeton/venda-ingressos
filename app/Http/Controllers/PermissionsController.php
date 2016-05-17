<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Requests;
use Bican\Roles\Models\Permission;

class PermissionsController extends Controller
{
    public function index($type = null)
    {
        return  $this->create($type);
    }

    public function create($type)
    {
        $permissions = Permission::all();

        return view('permissions.create', compact('permissions', 'type'));
    }

    public function store(Request $request, $type)
    {
        if($type == "user")
        {
            $object = User::find($request->o_id);
        }
        elseif ($type == "role")
        {
            $object = Role::find($request->o_id);    
        }
        
        $object->detachAllPermissions();

        if(isset($request->permissions))
        {
            foreach ($request->permissions as $permission)
            {
                $object->perm()->attach($permission);
            }
        }

        $permissions = Permission::all();
        
        return view('permissions.create', compact('permissions', 'type', 'object'));
    }

    public function edit($type, $id)
    {
        $permissions = Permission::all();

        if($type == "user")
        {
            $object = User::find($id);
        }
        elseif ($type == "role")
        {
            $object = Role::find($id);
        }

        if(isset($object->id))
        {
            return view('permissions.create', compact('permissions', 'type', 'object'));
        }
        else
        {
            return view('permissions.create', compact('permissions', 'type'));
        }
    }
}