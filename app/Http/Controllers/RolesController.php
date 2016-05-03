<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Bican\Roles\Models\Role;

class RolesController extends Controller
{
	public function index(Request $request)
	{
		$roles = Role::paginate(2);

        if( $request->ajax() )
        {
            return response()->json(\View::make('roles._rolesList', array('roles' => $roles))->render());
        }

		return view('roles.index', compact('roles'));
	}

	public function create()
	{		
		return view('roles.create');
	}

	public function store(Request $request)
	{
		Role::create($request->all());

		return redirect()->route('roles.index');
	}

	public function edit($id)
	{
		$role = Role::find($id);

		return view('roles.create',compact('role'));
	}
	
	public function update(Request $request, $id)
	{
		$role = Role::find($id)->update($request->all());
		
		return redirect()->route('roles.index');
	}

	public function delete($id)
	{		
		Role::find($id)->delete();
				
		return redirect('roles');
	}
}