<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParticipateController extends Controller
{
    public function get_all()
    {
        return get_user()->participates()->with('festival',function ($festival){
            $festival->select(['id','user_id','title','slug','logo'])->get();
        })->get();
    }
}
