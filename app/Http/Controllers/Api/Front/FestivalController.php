<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use App\Models\Festival_Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    public function specials(): \Illuminate\Http\JsonResponse
    {
        $data = Festival::query();
        $data->where('is_active',true)->where('force_close',false)->where('accepted',true)->whereDate('expire_at','>',Carbon::now());
        $data->where('is_special',true);
        return response()->json($data->with('category')->get());
    }

    public function expiring()
    {
        return response()->json(Festival::with('category')->where('is_active',true)->where('force_close',false)->where('accepted',true)->get());

    }

    public function categories()
    {
        return response()->json(Festival_Category::all());

    }

    public function all()
    {
        $data = Festival::query();
        $data->where('is_active',true)->where('force_close',false)->where('accepted',true)->whereDate('expire_at','>',Carbon::now());
        return response()->json($data->with('category')->with('user')->orderByDesc('id')->get());
    }

    public function show($slug)
    {

        return response()->json(Festival::where('slug',$slug)->where('is_active',true)->where('force_close',false)->where('accepted',true)
            ->with('user',function ($user){
                $user->select(['id','name','profile'])->get();
            })
            ->with('category')
            ->with('sponsors')
            ->select(['id','title','subtitle','user_id','festival_category_id','slug','logo','banner','description','terms'])
            ->firstorfail());

    }

    public function get_formats($slug)
    {
        $festival = Festival::where('slug',$slug)->first();
        $formats=[];
        $mimes=[];
        if (!empty($festival) && !empty($festival->formats)){
            $formats = unserialize($festival->formats);
        }
        if (!empty($festival) && !empty($festival->mimes)){
            $mimes = unserialize($festival->mimes);
        }
        return ['formats'=>$formats,'mimes'=>$mimes];
    }

    public function get_forms($slug)
    {
        $festival = Festival::where('slug',$slug)->first();
        $form=[];
        if (!empty($festival) && !empty($festival->forms)){
            $form = json_decode($festival->forms, false, 512, JSON_THROW_ON_ERROR);
        }
        return response()->json($form);
    }
}
