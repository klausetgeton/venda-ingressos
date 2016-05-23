<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class IngressoVendido extends Model
{
    use AuditingTrait;

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
    protected $fillable = ['users_id', 'data_cancelamento', 'data_compra', 'descontos_id', 'possibilidades_evento_id'];

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
    * Get the PossibilidadesEvento that owns the ingresso.
    */
    public function possibilidades_evento()
    {
        return $this->belongsTo('App\Model\PossibilidadesEvento');
    }
}
