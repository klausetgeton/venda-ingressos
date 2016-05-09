<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Bican\Roles\Models\Role;
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
    	$fullModalClass['Role'] = 'Bican\Roles\Models\Role';

    	$result = $fullModalClass[$model]::query();
        return Datatables::of($result)->make(true);
    }
}
