<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Model\Patrocinador;

class SponsorsController extends Controller
{    
	public function index()
	{				
		if(session()->has('event_multiple'))
		{
			$sponsors = Patrocinador::all();

			return view('sponsors.index', compact('sponsors'));

		}else
		{
			return view('events.index');						
		}
	}

    public function store(Request $request)
	{
		if($request->id)
		{
			$sponsor = Patrocinador::find($request->id);
		}

		if(isset($sponsor))
		{
			$sponsor->update($request->all());
		}else
		{
			$sponsor = Patrocinador::create($request->all());		
		}
					
		session()->flash('message', 'ok');		
		
		return response()->json('true');	
	}

	public function edit($id)
	{
		$sponsor = Patrocinador::find($id);

		if (request()->ajax())
		{
			return response()->json($sponsor);			
		}else
		{	
			return view('sponsors.create', compact('sponsor'));
		}
	}
	
	public function update(Request $request, $id)
	{
		$sponsor = Patrocinador::find($id)->update($request->all());
	
		session()->flash('message', 'ok');
		return redirect()->route('sponsors.index');
	}

	public function delete($id)
	{		
		Patrocinador::find($id)->delete();
		session()->flash('message', 'ok');

		if (request()->ajax())
		{
		 	return response()->json('true');	
		}else
		{
			return redirect()->route('sponsors.index');
		}	
	}
}