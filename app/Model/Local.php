<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Local extends AuditedObject
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locais';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao', 'nome', 'qtd_x', 'qtd_y'];

    /**
    * Get all the possibilidades_compra for the local.
    */
    public function possibilidades_compra()
    {
        return $this->hasMany('App\Model\PossibilidadeCompra');
    }

     /**
    * Get the eventos for the local.
    */
    public function evento()
    {
        return $this->belongsTo('App\Model\Evento', 'eventos_id');
    }  

}

