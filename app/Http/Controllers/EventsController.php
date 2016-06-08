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
			Evento::find($id)->update(['completo' => 'true']);

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

		return redirect()->route('sponsors.index');

		//return redirect()->route('events.index');
	}

	public function update(EventsRequest $request, $id)
	{
		$event = Evento::find($id)->update($request->all());
		session()->flash('message', 'ok');

		session()->put('event_multiple', 'true');
		session()->put('event_id', $request->id);

		return redirect()->route('sponsors.index');

		//return redirect()->route('events.index');
	}

	public function edit($id)
	{
		$event = Evento::find($id);

		return view('events.create',compact('event'));
	}

	public function delete($id)
	{		
		Evento::find($id)->delete();
		session()->flash('message', 'ok');
		return redirect()->route('events.index');
	}
}