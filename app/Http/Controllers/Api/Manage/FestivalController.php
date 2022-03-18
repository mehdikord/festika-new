<?php

namespace App\Http\Controllers\Api\Manage;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use App\Models\Festival_Category;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FestivalController extends Controller
{
    //categories
    public function categories()
    {
        return response()->json(Festival_Category::get());
    }
    public function categories_store(Request $request)
    {
        $request->merge(['name'=>str_replace(' ','-',$request->name)]);
        $validation = Validator::make($request->all(),[
            'name'=>'required|max:225|unique:festival_categories',
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        $item = Festival_Category::create(['name'=>$request->name,'description'=>$request->description]);
        return response()->json($item);

    }
    public function categories_edit(Request $request,Festival_Category $category)
    {
        $request->merge(['name'=>str_replace(' ','-',$request->name)]);
        $validation = Validator::make($request->all(),[
            'name'=>"required|max:225|unique:festival_categories,name,$category->id",
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        $category->update(['name'=>$request->name,'description'=>$request->description]);
        return response()->json('دسته بندی باموفقیت ویرایش شد');

    }
    public function categories_delete(Festival_Category $category)
    {
        $category->delete();
        return response()->json('دسته بندی باموفقیت حذف شد');

    }
    public function categories_single(Festival_Category $category)
    {
        return response()->json($category);

    }

    //festivals
    public function festivals()
    {
        return response()->json(Festival::whereDate("expire_at",'>',Carbon::now())->with('user')->with('category')->get());
    }

    //Expired Festivals
    public function festivals_expire()
    {
        return response()->json(Festival::whereDate("expire_at",'<',Carbon::now())->with('user')->with('category')->get());

    }

    public function festivals_store(Request $request)
    {
        $request->merge(['slug'=>str_replace(' ','-',$request->slug)]);
        $validation = Validator::make($request->all(),[
            'festival_category_id'=>'required|exists:festival_categories,id',
            'user_id'=>'required|exists:users,id',
            'slug'=>'required|unique:festivals',
            'title'=>'required|max:225',
            'subtitle'=>'nullable|max:225',
            'sends'=>'nullable|min:1',
            'formats'=>'required|array',
            'period'=>'required|numeric',
            'disk'=>'required|numeric|min:1',
            'quantity'=>'required|numeric|min:100',
            'start_at'=>'required',
            'is_special'=>'boolean',
            'commenting'=>'boolean'
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }

        $start_at = Carbon::make($request->start_at);
        $logo_url = null;
        if ($request->filled('logo')){

            $photo_name = 'public/images/festivals/logo/'.Str::random(12).'.'.'jpg';
            $photo = base64_to_jpeg($request->logo,$photo_name);
            $logo_url = asset(Storage::url($photo_name));
        }
        $banner_url = null;
        if ($request->filled('banner')){

            $photo_name = 'public/images/festivals/banner/'.Str::random(12).'.'.'jpg';
            $photo = base64_to_jpeg($request->banner,$photo_name);
            $banner_url = asset(Storage::url($photo_name));
        }
        $formats = null;
        $mimes = null;
        if ($request->filled('formats')){
            $mimes = mimes_generator($request->formats);
            $mimes = serialize($mimes);
            $formats = serialize($request->formats);
        }


        $festival = Festival::create([
            'user_id'=>$request->user_id,
            'creator_id'=>get_user()->id,
            'festival_category_id'=>$request->festival_category_id,
            'title'=>$request->title,
            'subtitle'=>$request->subtitle,
            'slug'=>$request->slug,
            'description'=>$request->description,
            'terms'=>$request->terms,
            'logo'=>$logo_url,
            'banner'=>$banner_url,
            'formats'=>$formats,
            'mimes'=>$mimes,
            'sends'=>$request->sends,
            'disk'=>$request->disk,
            'period'=>$request->period,
            'quantity'=>$request->quantity,
            'start_at'=>$start_at,
            'is_special'=>$request->is_special,
            'accepted'=>1,
        ]);
        $festival->update(['code'=>random_code($festival->id),'expire_at'=>$start_at->addDays($request->period)]);
        $invoice = Invoice::create([
            'user_id'=>$request->user_id,
            'creator_id'=>get_user()->id,
            'festival_id'=>$festival->id,
            'price'=>100000,
            'title'=>'ایجاد جشنواره',
            'festival_disk'=>$request->disk,
            'festival_period'=>$request->period,
            'festival_quantity'=>$request->quantity,
        ]);
        $invoice->update(['code'=>random_code($invoice->id)]);
        return response()->json("جشنواره جدید باموفقیت ایجاد شد");

    }


    public function festivals_edit(Request $request,Festival_Category $category)
    {
        $request->merge(['name'=>str_replace(' ','-',$request->name)]);
        $validation = Validator::make($request->all(),[
            'name'=>"required|max:225|unique:festival_festivals,name,$category->id",
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        $category->update(['name'=>$request->name,'description'=>$request->description]);
        return response()->json('دسته بندی باموفقیت ویرایش شد');

    }
    public function festivals_delete(Festival_Category $category)
    {
        $category->delete();
        return response()->json('دسته بندی باموفقیت حذف شد');

    }

    public function festivals_single(Festival_Category $category){

    }
}
