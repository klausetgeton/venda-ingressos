<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Bican\Roles\Models\Role;

use App\Http\Requests\RoleRequest;


class RolesController extends Controller
{
	public function index(Request $request)
	{
		
		$roles = Role::all();

		return view('roles.index', compact('roles'));
	}

	public function create()
	{		
		return view('roles.create');
	}

	public function store(RoleRequest $request)
	{
		Role::create($request->all());
		session()->flash('message', 'ok');
		return redirect()->route('roles.index');
	}

	public function edit($id)
	{
		$role = Role::find($id);

		return view('roles.create',compact('role'));
	}
	
	public function update(RoleRequest $request, $id)
	{
		$role = Role::find($id)->update($request->all());
		session()->flash('message', 'ok');
		return redirect()->route('roles.index');
	}

	public function delete($id)
	{		
		Role::find($id)->delete();
		session()->flash('message', 'ok');
		return redirect()->route('roles.index');
	}
}