<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Evento extends AuditedObject
{    

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
    protected $fillable = ['descricao', 'data', 'hora', 'nome', 'locais_id', 'valor_masculino', 'valor_feminino', 'completo'];

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
    * Get the local associated with the evento.
    */
    public function local()
    {
        return $this->belongsTo('App\Model\Local', 'locais_id');
    }
   /**
    * Get the administradores for the evento
    */
    public function administradores()
    {    
        return $this->belongsToMany('App\Model\User', 'administradores_evento');
    }
}
