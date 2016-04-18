<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Bican\Roles\Models\Role;

class RolesController extends Controller
{
	public function index()
	{
		$roles = Role::all();
		return view('roles.index',['roles'=>$roles]);
	}

	public function create()
	{		
		return view('roles.create');
	}


	public function store(Request $request)
	{
		$input = $request->all();
		Role::create($input);
		return redirect('roles');
	}

	public function edit($id)
	{
		$role = Role::find($id);
		return view('roles.create',compact('role'));
	}

	
	public function update(Request $request, $id)
	{
		$role = Role::find($id)->update($request->all());
		
		return redirect('roles');
	
	}
}