<?php

namespace App\Http\Controllers\Api\Manage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function new_users($count)
    {
        return response()->json(User::with('province')->with('city')->where('role',4)->OrderByDesc('id')->take($count)->get());
    }
}
