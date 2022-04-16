<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function top()
    {
        return response()->json(User::where('is_active',true)->whereHas('festivals')->with('festivals',function ($q){
            $q->select(['id','user_id']);
        })->take(8)->select(['id','name','profile'])->get()->sortBy(function ($festival){
           return $festival->festivals->count();
        }));

    }
}
