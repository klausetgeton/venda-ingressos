<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SoldTicketRequest extends Request
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
            'data_compra' => ['required'],
            'users_id' => ['required', 'integer'],
            'lotes_id' => ['required', 'integer'],
            'possibilidades_compra_id' => ['required', 'integer'],
            'descontos_id' => ['integer'],
            'valor' => ['required', 'numeric']
        ];
    }
}
