<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\PossibilidadeCompra;
use App\Model\Evento;

class PurchasePossibilityController extends Controller
{
    public function index(Request $request)
	{
		$ppossibility = PossibilidadeCompra::all();

		return view('ppossibility.index', compact('ppossibility'));
	}

	public function create()
	{
		return view('ppossibility.create');
	}

	public function store(Request $request)
	{
		PossibilidadeCompra::create($request->all());
		session()->flash('message', 'ok');
		return redirect()->route('ppossibility.index');
	}

	public function edit($id)
	{
		$role = PossibilidadeCompra::find($id);

		return view('ppossibility.create', compact('role'));
	}

	public function update(Request $request, $id)
	{
		$role = PossibilidadeCompra::find($id)->update($request->all());
		session()->flash('message', 'ok');
		return redirect()->route('ppossibility.index');
	}

	public function delete($id)
	{
		PossibilidadeCompra::find($id)->delete();
		session()->flash('message', 'ok');
		return redirect()->route('ppossibility.index');
	}

	public function getJsonListByEvent($events_id)
	{
		//$event = Evento::find($events_id);
		//$pc = $event->local->possibilidades_compra->where('disponivel', true);

		//return response()->json($pc);

		$event = Evento::find($events_id);

		return response()->json($event->possibilidadesCompra());
	}
}
