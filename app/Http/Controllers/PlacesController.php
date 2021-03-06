<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PlacesRequest;

use App\Model\Local;

use App\Model\PossibilidadeCompra;

class PlacesController extends Controller
{
	public function index()
	{
		$places = Local::all();

		return view('places.index', compact('places'));
	}

	public function create()
	{
		return view('places.create');
	}

	public function store(PlacesRequest $request)
	{
		$capacidade = (int) $request->qtd_x * (int) $request->qtd_y;
		$request->merge(array('capacidade' => $capacidade));

		$place = Local::create($request->all());

		$this->storePossibilities($place->id, $request->qtd_x, $request->qtd_y);

		session()->flash('message', 'ok');
		return redirect()->route('places.index');
	}

	public function edit($id)
	{
		$place = Local::find($id);

		return view('places.create',compact('place'));
	}

	public function update(PlacesRequest $request, $id)
	{
		$capacidade = (int) $request->qtd_x * (int) $request->qtd_y;
		$request->merge(array('capacidade' => $capacidade));

		$place = Local::find($id)->update($request->all());

		$this->storePossibilities($id, $request->qtd_x, $request->qtd_y);

		session()->flash('message', 'ok');
		return redirect()->route('places.index');
	}

	public function delete($id)
	{
		Local::find($id)->delete();
		session()->flash('message', 'ok');
		return redirect()->route('places.index');
	}

	private function storePossibilities($place_id, $qtd_x, $qtd_y)
	{
		//inative all possibilities from this place
		PossibilidadeCompra::where('locais_id', '=', $place_id)->update(['disponivel' => 'false']);

		//store the new possibilities and update the current to active
		for ($x=0; $x < $qtd_x; $x++)
		{
			for ($y=0; $y < $qtd_y; $y++)
			{
				$pc = PossibilidadeCompra::where('posicao_x', $x)
										 ->where('posicao_y', $y)
										 ->where('locais_id', $place_id)
										 ->get();

				//create if not exists or activate if exists
				if ($pc->isEmpty())
				{
    				$pc = new PossibilidadeCompra();
    				$pc->posicao_x = $x;
    				$pc->posicao_y = $y;
    				$pc->locais_id = $place_id;
    				$pc->disponivel = TRUE;
    				$pc->nome = self::getLetterByNumber($y) . $x;
    				$pc->save();
				}else
				{
					PossibilidadeCompra::where('id', '=', $pc[0]->id)->update(['disponivel' => 'true']);
				}
			}
		}
	}

	/**
	* transform number to letter, (0 = A; 26 = AA. 27 = AB)
	**/
	private function getLetterByNumber($number)
	{
		for($letter = ""; $number >= 0; $number = intval($number / 26) - 1)
        {
            $letter = chr($number%26 + 0x41) . $letter;
        }

		return $letter;
	}
}
