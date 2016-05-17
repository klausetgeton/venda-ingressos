<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Bican\Roles\Models\Role;
use App\Model\User;
use Yajra\Datatables\Datatables;
use OwenIt\Auditing\Log;

class DatatablesController extends Controller
{
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData($model = null)
    {
<<<<<<< HEAD
    	$fullModalClass['User'] = 'App\Model\User';
    	$fullModalClass['Role'] = 'Bican\Roles\Models\Role';
        $fullModalClass['Log']  = 'OwenIt\Auditing\Log';
=======
    	$fullModalClass['User'] = ['App\Model\User', ['id', 'name', 'email']];
    	$fullModalClass['Role'] = ['Bican\Roles\Models\Role', ['id', 'name']];
>>>>>>> 66673303c4ad2a334587d3d766c5c9867bf702f0

    	$result = $fullModalClass[$model][0]::get($fullModalClass[$model][1]);
        return Datatables::of($result)->make(true);
    }
}
