<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SoldTicketRequest;
use App\Model\IngressoVendido;
use App\Model\Evento;
use App\Model\Lote;


class SoldTicketController extends Controller
{
	public function index()
	{
		return view('tickets.index');
	}

    public function store(IngressoVendidoRequest $request)
	{
		IngressoVendido::create($request->all());

		return response()->json('true');
	}

	public function getJsonListByUser($users_id)
	{
		$result = IngressoVendido::where('users_id', $users_id)
			->with(array('desconto'=>function($query){$query->select('id','hash', 'porcentagem');}))
			->with(array('lote.evento.local'=>function($query){$query->select('id', 'nome', 'endereco', 'cidade');}))
			->with(array('possibilidade_compra'=>function($query){$query->select('id', 'posicao_x', 'posicao_y', 'nome');}))
			->with(array('user'=>function($query){$query->select('id', 'name');}))
			->get();
		return response()->json($result);
	}
}
