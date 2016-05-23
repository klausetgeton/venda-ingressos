<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\AuditingTrait;

class Lote extends Model
{
	use AuditingTrait;

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
    protected $fillable = ['descricao', 'data_inicio', 'nome', 'data_fim', 'quantidade', 'eventos_id'];

    /**
    * Get the modalidades for the lote.
    */
    public function modalidades()
    {
        return $this->hasMany('App\Model\ModalidadeLote');
    }
    
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
        return $this->belongsTo('App\Model\Evento');
    }
}
