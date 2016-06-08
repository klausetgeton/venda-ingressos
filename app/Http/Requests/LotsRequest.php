<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LotsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'max:150'],
            'dt_inicio' => ['required', 'date'],
            'dt_fim' => ['required', 'date'],
            'quantidade' => ['integer', 'required'],
            'valor_masculino' => ['numeric', 'required'],
            'valor_masculino' => ['numeric', 'required'],
            'eventos_id' => ['required'],
        ];
    }
}
