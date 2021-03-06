<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PlacesRequest extends Request
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
            'nome' => ['required', 'max:150', 'unique:locais' . ($this->id ? ',nome,'. $this->id : '')],
            'qtd_x' => ['required', 'integer'],
            'qtd_y' => ['required', 'integer'],
            'cidade' => ['required'],
            'endereco' => ['required']
        ];
    }
}
