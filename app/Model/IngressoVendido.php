<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IngressoVendido extends AuditedObject
{   

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ingressos_vendidos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id', 'data_cancelamento', 'data_compra', 'descontos_id', 'possibilidades_evento_id', 'lotes_id', 'data_pagamento'];

  /**
    * Get the desconto that owns the ingresso.
    */
    public function desconto()
    {
        return $this->belongsTo('App\Model\Desconto');
    }

    /**
    * Get the User that owns the ingresso.
    */
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    /**
    * Get the Lote that owns the ingresso.
    */
    public function lote()
    {
        return $this->belongsTo('App\Model\Lote');
    }

    /**
    */
    public function possibilidade_compra()
    {
        return $this->belongsTo('App\Model\PossibilidadesCompra');
    }
}
