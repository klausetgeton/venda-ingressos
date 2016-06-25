<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\EventsRequest;

use App\Model\Evento;

class EventsController extends Controller
{
	public function index()
	{
		$events = Evento::all();

		return view('events.index', compact('events'));
	}

	public function finish($id)
	{
		if(session()->has('event_multiple'))
		{
			$event = Evento::find($id);

			//validating number of tickets
			//cant start an event without solding any ticket
			if($event->lotes == null)
			{
				$errors[] = 'Este evento precisa ter ao menos um lote de ingressos cadastrado';
				return view('lots.create', compact('errors'));
			}

			//validating number of tickets
			//cant sell more tickets than the local capacity
			$totalTickets = 0;
			foreach ($event::find($id)->lotes as $lot) {
				$totalTickets += $lot->quantidade;
			}
			if($totalTickets > $event->local->capacidade)
			{
				$errors[] = 'O número de ingressos a venda neste evento(' . $totalTickets . ') não deve ultrapassar a capacidade do Local(' . $event->local->capacidade . ')';
				return view('lots.create', compact('errors'));
			}

			$event::find($id)->update(['completo' => 'true']);

			session()->forget('event_multiple');
			session()->forget('event_id');
			session()->flash('message', 'ok');

			return view('events.index');
		}else
		{
			return view('events.index');
		}
	}

	public function create()
	{
		return view('events.create');
	}

	public function store(EventsRequest $request)
	{
		$event = Evento::create($request->all());

		session()->flash('message', 'ok');

		session()->put('event_multiple', 'true');
		session()->put('event_id', $event->id);

		return redirect()->route('sponsors.create');

		//return redirect()->route('events.index');
	}

	public function update(EventsRequest $request, $id)
	{
		$event = Evento::find($id)->update($request->all());
		session()->flash('message', 'ok');

		return redirect()->route('sponsors.create');

		//return redirect()->route('events.index');
	}

	public function edit($id)
	{
		$event = Evento::find($id);

		session()->put('event_multiple', 'true');
		session()->put('event_id', $id);

		return view('events.create',compact('event'));
	}

	public function delete($id)
	{
		Evento::find($id)->delete();
		session()->flash('message', 'ok');
		return redirect()->route('events.index');
	}

	public function getJsonList()
	{
		//we should filter between dates in the next version
		$events = Evento::where('completo', true)->with('local')->get();

		return response()->json($events);
	}
}