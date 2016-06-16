<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SoldTicketRequest;
use App\Model\IngressoVendido;
use App\Model\Evento;

class SoldTicketController extends Controller
{
    public function store(IngressoVendidoRequest $request)
	{
		IngressoVendido::create($request->all());

		return response()->json('true');
	}
}
