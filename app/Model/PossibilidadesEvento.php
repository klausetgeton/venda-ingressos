<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class PossibilidadesEvento extends Model
{
	use AuditingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'possibilidades_evento';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['possibilidades_compra_id', 'evento_id'];

    /**
    * Get the IngressosVendidos for the PossibilidadesEvento
    */
    public function ingressos_vendidos()
    {
        return $this->hasMany('App\Model\IngressoVendido');
    }   
}
