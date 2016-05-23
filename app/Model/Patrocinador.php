<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class Patrocinador extends Model
{
	use AuditingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patrocinadores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao', 'eventos_id', 'logo', 'nome'];

    /**
    * Get the evento that owns the Patrocinador.
    */
    public function evento()
    {
        return $this->belongsTo('App\Model\Evento');
    }
}
