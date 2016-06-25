<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bican\Roles\Models\Role;
use App\Model\User;
use Yajra\Datatables\Datatables;
use OwenIt\Auditing\Log;

class DatatablesController extends Controller
{
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData(Request $request, $model = null)
    {
    	$fullModalClass['User'] = ['App\Model\User', ['id', 'name', 'email']];
    	$fullModalClass['Role'] = ['Bican\Roles\Models\Role', ['id', 'name']];
        $fullModalClass['Log']  = ['OwenIt\Auditing\Log', ['user_id', 'type','owner_id', 'old_value','new_value','owner_type','created_at']];
        $fullModalClass['Evento'] = ['App\Model\Evento', ['id', 'nome', 'data', 'hora']];
        $fullModalClass['Local'] = ['App\Model\Local', ['id', 'nome', 'descricao', 'capacidade', 'endereco', 'cidade']];
        $fullModalClass['Patrocinador'] = ['App\Model\Patrocinador', ['id', 'nome', 'descricao', 'eventos_id']];
        $fullModalClass['Desconto'] = ['App\Model\Desconto', ['id', 'descricao', 'hash', 'quantidade' ,'porcentagem','eventos_id']];
        $fullModalClass['Lote'] = ['App\Model\Lote', ['id', 'descricao', 'dt_inicio', 'nome', 'dt_fim', 'quantidade', 'eventos_id', 'valor_masculino', 'valor_feminino']];
        $fullModalClass['IngressoVendido'] = ['App\Model\IngressoVendido', ['id', 'data_cancelamento', 'data_compra', 'data_pagamento', 'valor']];


        switch ($model)
        {
            case 'Evento':
                $result = $fullModalClass[$model][0]::with('local')->get();
                return Datatables::of($result)
                                ->editColumn('data', function ($obj)
                                    {
                                        return date('d-m-Y', strtotime($obj->data));
                                    })
                                ->make(true);

            case 'Patrocinador':
                if($request->get('eventos_id'))
                {
                    $result = $fullModalClass[$model][0]::select($fullModalClass[$model][1])->where('eventos_id', (int) $request->get('eventos_id'))->get();
                }else
                {
                    $result = $fullModalClass[$model][0]::select($fullModalClass[$model][1])->with('evento')->get();
                }

                return Datatables::of($result)->make(true);
                break;

            case 'Desconto':
                if($request->get('eventos_id'))
                {
                    $result = $fullModalClass[$model][0]::select($fullModalClass[$model][1])->where('eventos_id', (int) $request->get('eventos_id'))->with('evento')->get();
                }else
                {
                    $result = $fullModalClass[$model][0]::select($fullModalClass[$model][1])->with('evento')->get();
                }

                return Datatables::of($result)
                                ->editColumn('porcentagem', function ($obj)
                                    {
                                        return $obj->porcentagem . " %";
                                    })
                                ->make(true);
                break;

            case 'Lote':
                if($request->get('eventos_id'))
                {
                    $result = $fullModalClass[$model][0]::where('eventos_id', (int) $request->get('eventos_id'))->with('evento')->get();
                }else
                {
                    $result = $fullModalClass[$model][0]::with('evento')->get();
                }

                return Datatables::of($result)
                                ->editColumn('porcentagem', function ($obj)
                                    {
                                        return $obj->porcentagem . " %";
                                    })
                                ->editColumn('valor_masculino', function ($obj)
                                    {
                                        return 'R$' . number_format($obj->valor_masculino, 2, ',', '.');;
                                    })
                                ->editColumn('valor_feminino', function ($obj)
                                    {
                                        return 'R$' . number_format($obj->valor_feminino, 2, ',', '.');;
                                    })
                                ->editColumn('dt_inicio', function ($obj)
                                    {
                                        return date('d-m-Y', strtotime($obj->dt_inicio));
                                    })
                                ->editColumn('dt_fim', function ($obj)
                                    {
                                        return date('d-m-Y', strtotime($obj->dt_fim));
                                    })
                                ->addColumn('vendidos', function ($obj)
                                    {
                                        return $obj->ingressosVendidosCount();
                                    })
                                ->make(true);
                break;

            case 'IngressoVendido':
                $result = $fullModalClass[$model][0]::with(['desconto', 'lote.evento', 'possibilidade_compra', 'user'])->get();
                return Datatables::of($result)
                                    ->editColumn('data_compra', function ($obj)
                                    {
                                        return date('d-m-Y h:m:s', strtotime($obj->data_compra))    ;
                                    })
                                    ->editColumn('data_pagamento', function ($obj)
                                    {
                                        return isset($obj->data_pagamento) ? date('d-m-Y h:m:s', strtotime($obj->data_pagamento)) : null;
                                    })
                                    ->editColumn('data_cancelamento', function ($obj)
                                    {
                                        return isset($obj->data_cancelamento) ? date('d-m-Y h:m:s', strtotime($obj->data_cancelamento)) : null;
                                    })
                                    ->editColumn('valor', function ($obj)
                                    {
                                        return 'R$' . number_format($obj->valor, 2, ',', '.');;
                                    })
                                ->make(true);

            default:
                $result = $fullModalClass[$model][0]::select($fullModalClass[$model][1])->get();
                return Datatables::of($result)->make(true);
                break;
        }
    }
}
