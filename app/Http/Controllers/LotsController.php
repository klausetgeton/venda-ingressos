<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Model\Lote;
use App\Http\Requests\LotsRequest;

class LotsController extends Controller
{

	public function index()
	{
		return view('lots.index');
	}

	public function create()
	{
		if(session()->has('event_multiple'))
		{
			return view('lots.create');
		}else
		{
			return view('events.index');
		}
	}

    public function store(LotsRequest $request)
	{
		if($request->id)
		{
			$lot = Lote::find($request->id);
		}

		if(isset($lot))
		{
			$lot->update($request->all());
		}else
		{
			$lot = Lote::create($request->all());
		}

		return response()->json('true');
	}

	public function edit($id)
	{
		$lot = Lote::find($id);

		if (request()->ajax())
		{
			return response()->json($lot);
		}else
		{
			return redirect()->route('lots.index');
		}
	}

	public function update(LotsRequest $request, $id)
	{
		$lot = Lote::find($id)->update($request->all());

		session()->flash('message', 'ok');
		return redirect()->route('lots.index');
	}

	public function delete($id)
	{
		Lote::find($id)->delete();
		session()->flash('message', 'ok');

		if (request()->ajax())
		{
		 	return response()->json('true');
		}else
		{
			return redirect()->route('lots.index');
		}
	}
}
