<?php

namespace App\Http\Controllers\Api\Manage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function get_managers()
    {
        return response()->json(User::whereNotNull('role')->where('role','<',4)->with('province')->with('city')->get());
    }

    public function managers_store(Request $request)
    {
        $validation = Validator::make($request->all(),[
           'name'=>'required|max:225',
           'phone'=>'required|numeric|unique:users',
           'email'=>'nullable|email|unique:users',
           'province_id'=>'nullable|exists:provinces,id',
           'city_id'=>'nullable|exists:cities,id',
           'role'=>'required|numeric|min:1|max:3',
           'gender'=>'required|boolean',
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        $photo_url = null;
        if ($request->filled('profile')){

            $photo_name = 'public/images/users/'.Str::random(12).'.'.'jpg';
            $photo = base64_to_jpeg($request->profile,$photo_name);
            $photo_url = asset(Storage::url($photo_name));
        }
        User::create([
            'role'=>$request->role,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'province_id'=>$request->province_id,
            'city_id'=>$request->city_id,
            'gender'=>$request->gender,
            'profile'=>$photo_url,

        ]);
        return response()->json('مدیر جدید باموفقیت ایجاد شد');
    }

    public function managers_edit(User $user,Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required|max:225',
            'phone'=>"required|numeric|unique:users,phone,$user->id",
            'email'=>"nullable|email|unique:users,email,$user->id",
            'province_id'=>'nullable|exists:provinces,id',
            'city_id'=>'nullable|exists:cities,id',
            'role'=>'required|numeric|min:1|max:3',
            'gender'=>'required|boolean',
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        $photo_url = $user->profile;
        if ($request->filled('profile') && $request->profile != $photo_url){
            $photo_name = 'public/images/users/'.Str::random(12).'.'.'jpg';
            $photo = base64_to_jpeg($request->profile,$photo_name);
            $photo_url = asset(Storage::url($photo_name));
        }
        $user->update([
            'role'=>$request->role,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'province_id'=>$request->province_id,
            'city_id'=>$request->city_id,
            'gender'=>$request->gender,
            'profile'=>$photo_url,
        ]);
        return response()->json('اطلاعات مورد نظر باموفقیت ویرایش شد');
    }

    public function managers_delete(User $user)
    {
        $user->delete();
        return response()->json('مدیر مورد نظر باموفقیت حذف شد');
    }

    public function managers_activation(User $user)
    {
        if ($user->is_active == 0){
            $user->update(['is_active'=>1]);
        }else{
            $user->update(['is_active'=>0]);
        }
        return response()->json($user->is_active);

    }

    public function managers_single(User $user)
    {
        return response()->json($user);
    }

    public function get_members()
    {
        return response()->json(User::whereNotNull('role')->where('role',4)->with('province')->with('city')->get());
    }

    public function members_store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required|max:225',
            'phone'=>'required|numeric|unique:users',
            'email'=>'nullable|email|unique:users',
            'province_id'=>'nullable|exists:provinces,id',
            'city_id'=>'nullable|exists:cities,id',
            'gender'=>'required|boolean',
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        $photo_url = null;
        if ($request->filled('profile')){

            $photo_name = 'public/images/users/'.Str::random(12).'.'.'jpg';
            $photo = base64_to_jpeg($request->profile,$photo_name);
            $photo_url = asset(Storage::url($photo_name));
        }
        User::create([
            'role'=>4,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'province_id'=>$request->province_id,
            'city_id'=>$request->city_id,
            'gender'=>$request->gender,
            'profile'=>$photo_url,

        ]);
        return response()->json('کاربر جدید باموفقیت ایجاد شد');
    }

    public function members_edit(User $user,Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required|max:225',
            'phone'=>"required|numeric|unique:users,phone,$user->id",
            'email'=>"nullable|email|unique:users,email,$user->id",
            'province_id'=>'nullable|exists:provinces,id',
            'city_id'=>'nullable|exists:cities,id',
            'gender'=>'required|boolean',
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        $photo_url = $user->profile;
        if ($request->filled('profile')){

            $photo_name = 'public/images/users/'.Str::random(12).'.'.'jpg';
            $photo = base64_to_jpeg($request->profile,$photo_name);
            $photo_url = asset(Storage::url($photo_name));

        }
        $user->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'province_id'=>$request->province_id,
            'city_id'=>$request->city_id,
            'gender'=>$request->gender,
            'profile'=>$photo_url,
        ]);
        return response()->json('اطلاعات مورد نظر باموفقیت ویرایش شد');
    }

    public function members_delete(User $user)
    {
        $user->delete();
        return response()->json('کاربر مورد نظر باموفقیت حذف شد');
    }

    public function members_activation(User $user)
    {
        if ($user->is_active === 0){
            $user->update(['is_active'=>1]);
        }else{
            $user->update(['is_active'=>0]);
        }
        return response()->json($user->is_active);

    }

    public function members_single(User $user)
    {
        return response()->json($user);
    }

}
