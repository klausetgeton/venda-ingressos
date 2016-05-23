<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\AuditingTrait;

class Evento extends Model
{
    use AuditingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'eventos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao', 'datahora', 'nome'];

   /**
    * Get the lotes for the evento
    */
    public function lotes()
    {
        return $this->hasMany('App\Model\Lote');
    }

    /**
    * Get the patrocinadores for the evento
    */
    public function patrocinadores()
    {
        return $this->hasMany('App\Model\Patrocinador');
    }

    /**
    * Get the descontos for the evento
    */
    public function descontos()
    {
        return $this->hasMany('App\Model\Desconto');
    }

    /**
    * Get the PossibilidadesCompra for the evento
    */
    public function possibilidades_compra()
    {    
        return $this->belongsToMany('App\Model\PossibilidadesCompra', 'possibilidades_evento');
    }

   /**
    * Get the administradores for the evento
    */
    public function administradores()
    {    
        return $this->belongsToMany('App\Model\User', 'administradores_evento');
    }
}
