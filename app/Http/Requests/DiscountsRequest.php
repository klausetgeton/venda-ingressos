<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DiscountsRequest extends Request
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
            'porcentagem' => ['integer', 'required', 'max:100'],
            'quantidade' => ['integer', 'required'],            
            'hash' => ['required', 'max:20', 'min:5', 'unique:descontos' . ($this->id ? ',hash,'. $this->id : '')],       
        ];
    }
}

