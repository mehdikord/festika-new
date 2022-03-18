<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Festival_Category;
use App\Models\Province;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function all_provinces(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Province::with('cities')->get());
    }

    public function festival_categories(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Festival_Category::all());

    }
}
