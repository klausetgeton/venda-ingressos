<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdministradoresEvento extends AuditedObject
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
