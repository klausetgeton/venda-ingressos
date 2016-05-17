<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 17/05/16
 * Time: 13:42
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\User;

class SeekController extends Controller
{
    /**
     * Find object by id
     *
     * @return json with id and description
     *
     */
    public function findById($model, $description_column, $id)
    {
        $fullModalClass['User'] = ['App\Model\User', ['id', 'name', 'email']];
        $fullModalClass['Role'] = ['Bican\Roles\Models\Role', ['id', 'name']];

        $querySelector = $fullModalClass[$model][0]::where('id', '=' ,"$id");

        return $querySelector->get(['id', $description_column ])->toJson();
    }
}

