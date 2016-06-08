<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventsRequest extends Request
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
            'data' => ['required', 'date'],
            'hora' => ['date_format:H:m'],
            'locais_id' => ['required'],
        ];
    }
}
