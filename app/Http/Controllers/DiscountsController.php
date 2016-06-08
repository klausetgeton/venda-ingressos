<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Model\Desconto;
use App\Http\Requests\DiscountsRequest;

class DiscountsController extends Controller
{
    
	public function index()
	{	
		if(session()->has('event_multiple'))
		{
			$discounts = Desconto::all();

			return view('discounts.index', compact('discounts'));
		}else
		{
			return view('events.index');						
		}	
	}

    public function store(DiscountsRequest $request)
	{		
		$request->eventos_id == "" ? $request->merge(array('eventos_id' => NULL)) : "" ; 

		if($request->id)
		{
			$discount = Desconto::find($request->id);
		}

		if(isset($discount))
		{
			$discount->update($request->all());
		}else
		{
			$discount = Desconto::create($request->all());		
		}
							
		return response()->json('true');	
	}

	public function edit($id)
	{
		$discount = Desconto::find($id);

		if (request()->ajax())
		{
			return response()->json($discount);			
		}else
		{
			return view('discounts', compact('discount'));
		}
	}
	
	public function update(DiscountsRequest $request, $id)
	{
		$discount = Desconto::find($id)->update($request->all());
	
		session()->flash('message', 'ok');
		return redirect()->route('discounts.index');
	}

	public function delete($id)
	{		
		Desconto::find($id)->delete();
		session()->flash('message', 'ok');

		if (request()->ajax())
		{
		 	return response()->json('true');	
		}else
		{
			return redirect()->route('discounts.index');
		}	
	}
}
