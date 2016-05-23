<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class ModalidadeLote extends Model
{
	use AuditingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modalidades_lote';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao', 'lotes_id', 'valor'];

    /**
     * Get the lote that owns the modalidade.
     */
    public function lote()
    {
        return $this->belongsTo('App\Model\Lote');
    }
}
