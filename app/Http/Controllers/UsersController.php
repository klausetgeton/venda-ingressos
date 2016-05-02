<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\User;

class UsersController extends Controller
{

	public function teste()
	{		
		return view('users.teste');
	}

	public function testeAjax($search = null)
    {
        $users = User::where('name', 'like', "%$search%")->get();
        //$users = User::all();
        //return Response::json($users);
        return response()->json($users);
    }

	public function index()
	{
		$users = User::all();

		return view('users.index', compact('users'));
	}

	public function create()
	{		
		return view('users.create');
	}

	public function store(Request $request)
	{
		User::create($request->all());

		return redirect()->route('users.index');
	}

	public function edit($id)
	{
		$user = User::find($id);

		return view('users.create', compact('user'));
	}

	
	public function update(Request $request, $id)
	{
		$user = User::find($id)->update($request->all());
		
		return redirect()->route('users.index');
	}


	public function delete($id)
	{		
		User::find($id)->delete();
				
		return redirect()->route('users.index');
	}
}