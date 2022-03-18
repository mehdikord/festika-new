<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    public function specials(): \Illuminate\Http\JsonResponse
    {
        $data = Festival::query();
        $data->where('is_active',true)->whereDate('expire_at','>',Carbon::now());
        $data->where('is_special',true);
        return response()->json($data->with('category')->get());
    }

    public function expiring()
    {
        return response()->json(Festival::with('category')->get());

    }
}
