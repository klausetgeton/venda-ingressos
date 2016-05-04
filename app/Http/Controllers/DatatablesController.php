<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Model\Role;
use App\Model\User;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData($model = null)
    {
    	$fullModalClass['User'] = 'App\Model\User';
    	$fullModalClass['Role'] = 'App\Model\Role';

    	$users = $fullModalClass[$model]::query();
        return Datatables::of($users)        	
        	->make(true);
    }
}
