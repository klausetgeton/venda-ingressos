<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class Desconto extends Model
{
   
    use AuditingTrait;

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
    protected $fillable = ['descricao', 'hash', 'porcentagem', 'quantidade', 'eventos_id', 'lotes_id'];

    /**
    * Get the evento that owns the desconto.
    */
    public function evento()
    {
        return $this->belongsTo('App\Model\Evento');
    }

    /**
    * Get the lote that owns the desconto.
    */
    public function lote()
    {
        return $this->belongsTo('App\Model\Lote');
    }

   /**
    * Get the ingressos_vendidos for the desconto
    */
    public function ingressos_vendidos()
    {
        return $this->hasMany('App\Model\IngressoVendido');
    }
}
