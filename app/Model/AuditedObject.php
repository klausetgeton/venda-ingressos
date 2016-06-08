<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class AuditedObject extends Model
{
    use AuditingTrait;
}
