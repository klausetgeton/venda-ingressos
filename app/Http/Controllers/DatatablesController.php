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
    	$fullModalClass['User'] = ['App\Model\User', ['id', 'name', 'email']];
    	$fullModalClass['Role'] = ['Bican\Roles\Models\Role', ['id', 'name']];

    	$result = $fullModalClass[$model][0]::get($fullModalClass[$model][1]);
        return Datatables::of($result)->make(true);
    }
}
