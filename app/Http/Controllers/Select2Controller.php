<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\User;
use Yajra\Datatables\Datatables;


class Select2Controller extends Controller
{
    
	public function getData(Request $request, $model, $search_collumn)
	{	
		$fullModalClass['User'] = 'App\Model\User';
    	$fullModalClass['Role'] = 'Bican\Roles\Models\Role';

		$q = $request->input('q');		

		$data = $fullModalClass[$model]::where($search_collumn, 'like' ,'%'. $q . '%')->get()->toJson();

		return $data;
	}

}
