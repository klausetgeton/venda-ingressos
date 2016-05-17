<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request
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
            'name'  => ['required'],
            'rg'    => ['max:10', 'unique:users' . ($this->id ? ',rg,'. $this->id : '')],
            'cpf'   => ['max:14', 'unique:users' . ($this->id ? ',cpf,'. $this->id : '')],
            'email' => ['email', 'max:100', 'required', 'unique:users' . ($this->id ? ',email,'. $this->id : '')],            
        ];
    }
}
