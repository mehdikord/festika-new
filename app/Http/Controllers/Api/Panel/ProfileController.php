<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = get_user();

        $validation = Validator::make($request->all(),[
            'name'=>'required|min:3|max:225',
            'email'=>"nullable|email|unique:users,email,$user->id",
            'city_id'=>'nullable|exists:cities,id',
            'province_id'=>'nullable|exists:provinces,id',
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
            'name'=>$request->name,
            'email'=>$request->email,
            'province_id'=>$request->province_id,
            'city_id'=>$request->city_id,
            'gender'=>$request->gender,
            'bio'=>$request->bio,
            'profile'=>$photo_url,
        ]);
        return response()->json('اطلاعات حساب کاربری شما باموفقیت ویرایش شد');
    }
}
