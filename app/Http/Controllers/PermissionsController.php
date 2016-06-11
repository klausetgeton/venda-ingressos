<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionsRequest;
use App\Http\Requests;
use Bican\Roles\Models\Permission;

class PermissionsController extends Controller
{
    public function index($type)
    {
        return  $this->create($type);
    }

    public function create($type)
    {
        $permissions = Permission::all();

        return view('permissions.create', compact('permissions', 'type'));
    }

    public function getTable($type, $id)
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
            return view('permissions._table', compact('permissions', 'type', 'object'));
        }
        else
        {
            return view('permissions._table', compact('permissions', 'type'));
        }
    }

    public function store(PermissionsRequest $request, $type)
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

        session()->flash('message', 'ok');
        return view('permissions.create', compact('type', 'object'));
    }
}