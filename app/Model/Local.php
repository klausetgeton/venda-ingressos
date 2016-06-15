<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Local extends AuditedObject
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locais';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao', 'nome', 'qtd_x', 'qtd_y', 'capacidade', 'cidade', 'endereco'];

    /**
    * Get all the possibilidades_compra for the local.
    */
    public function possibilidades_compra()
    {
        return $this->hasMany('App\Model\PossibilidadeCompra', 'locais_id');
    }

     /**
    * Get the eventos for the local.
    */
    public function evento()
    {
        return $this->belongsToMany('App\Model\Evento', 'eventos_id');
    }

    public function delete()
    {
        // delete all related objects
        $this->possibilidades_compra()->delete();

        // delete the user
        return parent::delete();
    }
}

