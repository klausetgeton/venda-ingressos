<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SoldTicketRequest;
use App\Model\IngressoVendido;
use App\Model\Evento;
use Tymon\JWTAuth\Facades\JWTAuth;

class SoldTicketController extends Controller
{
    public function store(Request $request)
	{
        $dadosRequest = $request->all();

        $usuario = JWTAuth::parseToken()->toUser();

        foreach ($dadosRequest['acentos'] as $acento) {
            $ingressoVendido = new IngressoVendido;
            $ingressoVendido->possibilidades_compra_id = $acento['id'];
            $ingressoVendido->users_id = $usuario->id;
            $ingressoVendido->data_compra = date('Y-m-d H:i:s');
            // APENAS PARA TESTAR
            $ingressoVendido->lotes_id = $acento['loteId'];
            $ingressoVendido->descontos_id =  null; // $acento['descontos_id'];
            $ingressoVendido->valor = $acento['valor'];
            $ingressoVendido->save();
        }

        return response()->json([ 'ingressos_vendidos' => true ], 200);
	}
}
