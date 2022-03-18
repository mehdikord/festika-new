<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth_Sms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required|max:225',
            'phone'=>'required|numeric|unique:users',
            'email'=>'nullable|email|unique:users',
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        $code = rand(100000,999999);
        Auth_Sms::UpdateorCreate(['phone'=>$request->phone],['code'=>$code]);
        $user = [
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
        ];
        helper_send_auth_sms($request->phone,$code);
        return response()->json($user);

    }

    public function register_check(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required|max:225',
            'code'=>'required|numeric',
            'phone'=>'required|numeric|unique:users',
            'email'=>'nullable|email|unique:users',
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        $find_code = Auth_Sms::where("code",$request->code)->where('phone',$request->phone)->first();
        if (!empty($find_code)){
            if (helper_check_sms_time($find_code->id)) {
                $find_code->delete();
                $token = Str::random(120);
                $user = User::create([
                    'role'=>4,
                    'name'=>$request->name,
                    'phone'=>$request->phone,
                    'email'=>$request->email
                ]);
                return response()->json(['user'=>$user,'access_token'=>$token]);
            }
            $code = rand(100000,999999);
            $find_code->update(['code'=>$code]);
            helper_send_auth_sms($find_code->phone,$code);
            return response()->json('مدت زمان ارسال کد به پایان رسیده است، کد تایید جدید برای شما ارسال شد، لطفا آن را وارد کنید',410);

        }
        return response()->json('کد ارسال شده نادرست است',409);


    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone'=>'required|numeric',
       ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        $user = User::where('phone',$request->phone)->first();
        if (!empty($user)){
            $code = rand(100000,999999);
            Auth_Sms::UpdateorCreate(['phone'=>$request->phone],['code'=>$code]);
            helper_send_auth_sms($user->phone,$code);
            return response()->json($user->phone,200);
        }
        return response()->json("کاربر گرامی هیچ حسابی با این شماره موبایل یافت نشد، برای ادامه با این شماره ابتدا ثبت نام کنید",409);

    }

    public function login_check(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'code'=>'required|numeric',
            'phone'=>'required|numeric|exists:users,phone',
        ]);
        $find_code = Auth_Sms::where("code",$request->code)->where('phone',$request->phone)->first();
        if (!empty($find_code)){
            if (helper_check_sms_time($find_code->id)) {
                $find_code->delete();
                $user = User::where('phone',$request->phone)->first();
                $token = Str::random(120);
                $user->update(['api_token'=>$token]);
                $user = [
                    'role'=>$user->role,
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'profile'=>$user->profile,
                    'gender'=>$user->gender
                ];
                return response()->json(['user'=>$user,'access_token'=>$token]);
            }
            $code = rand(100000,999999);
            $find_code->update(['code'=>$code]);
            helper_send_auth_sms($find_code->phone,$code);
            return response()->json('مدت زمان ارسال کد به پایان رسیده است، کد تایید جدید برای شما ارسال شد، لطفا آن را وارد کنید',410);

        }
        return response()->json('کد ارسال شده نادرست است',411);
    }

    public function get_me()
    {
        return response()->json(User::where('api_token',\request()->header('Authorization'))->first());
    }

}
