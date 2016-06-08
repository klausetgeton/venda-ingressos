<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\AuditedObject;

class Desconto extends AuditedObject
{   

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'descontos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao', 'hash', 'porcentagem', 'quantidade', 'eventos_id'];

    /**
    * Get the evento that owns the desconto.
    */
    public function evento()
    {
        return $this->belongsTo('App\Model\Evento', 'eventos_id');
    }   

   /**
    * Get the ingressos_vendidos for the desconto
    */
    public function ingressos_vendidos()
    {
        return $this->hasMany('App\Model\IngressoVendido');
    }
}
