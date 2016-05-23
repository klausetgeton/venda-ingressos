<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class PossibilidadeCompra extends Model
{
	use AuditingTrait;

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
    protected $fillable = ['posicao_x', 'posicao_y'];

    /**
    * Get the eventos for the PossibilidadeCompra
    */
    public function eventos()
    {    
        return $this->belongsToMany('App\Model\Evento', 'possibilidades_evento');
    }
}
