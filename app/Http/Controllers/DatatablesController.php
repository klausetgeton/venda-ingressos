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
    	$fullModalClass['User'] = ['App\Model\User', ['id', 'name', 'email']];
    	$fullModalClass['Role'] = ['Bican\Roles\Models\Role', ['id', 'name']];
        $fullModalClass['Log']  = ['OwenIt\Auditing\Log', ['user_id', 'owner_id', 'old_value','new_value','owner_type','created_at']];

    	$result = $fullModalClass[$model][0]::select($fullModalClass[$model][1])->get();        
        
        if($model == "Log")
        {
            return Datatables::of($result)
            ->editColumn('old_value', function ($obj) 
            {
                $ret = "";
                
                if($obj->old_value)
                {
                    foreach ($obj->old_value as $value) 
                    {                
                        if($value)
                        {
                            $ret = $ret . $value . "; ";                    
                        }
                    }
                }

                return $ret;
            })
            ->editColumn('new_value', function ($obj) 
            {
                $ret = "";
                
                if($obj->new_value)
                {
                    foreach ($obj->new_value as $value) 
                    {                
                        if($value)
                        {
                            $ret = $ret . $value . "; ";                    
                        }
                    }
                }

                return $ret;
            })
            ->make(true);

        }
        else
        {
            return Datatables::of($result)->make(true);    
        }
    }
}
