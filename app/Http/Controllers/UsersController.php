<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\User;

class UsersController extends Controller
{
	public function index()
	{
		$users = User::all();
		return view('users.index',['users'=>$users]);
	}

	public function create()
	{		
		return view('users.create');
	}


	public function store(Request $request)
	{
		$input = $request->all();		
		User::create($input);
		return redirect('users');
	}

	public function edit($id)
	{
		$user = User::find($id);
		return view('users.create',compact('user'));
	}

	
	public function update(Request $request, $id)
	{
		$user = User::find($id)->update($request->all());
		
		return redirect('users');
	
	}


	public function delete($id)
	{		
		User::find($id)->delete();
				
		return redirect('users');
	}
}