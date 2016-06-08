<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PossibilidadeCompra extends Model
{
	

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'possibilidades_compra';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['posicao_x', 'nome', 'disponivel', 'posicao_y', 'locais_id'];

    /**
    * Get the eventos for the PossibilidadeCompra
    */
    public function locais()
    {    
        return $this->belongsToMany('App\Model\Local');
    }
}
