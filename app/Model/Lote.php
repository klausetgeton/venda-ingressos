<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lote extends AuditedObject
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lotes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao', 'dt_inicio', 'nome', 'dt_fim', 'quantidade', 'eventos_id', 'valor_masculino', 'valor_feminino'];

        
    /**
    * Get the descontos for the lote.
    */
    public function descontos()
    {
        return $this->hasMany('App\Model\Desconto');
    }

    /**
    * Get the evento that owns the lote.
    */
    public function evento()
    {
        return $this->belongsTo('App\Model\Evento', 'eventos_id');
    }
}
