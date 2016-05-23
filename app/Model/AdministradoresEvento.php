<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class AdministradoresEvento extends Model
{
    
    use AuditingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'administradores_evento';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['eventos_id', 'users_id'];
}
