<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact_Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required|max:225',
            'phone'=>'required|numeric',
            'email'=>'nullable|email',
            'subject'=>'nullable|max:225',
            'message'=>'required',
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        Contact_Message::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ]);
        return response()->json('پیام شما باموفقیت ارسال شد، باتشکر از شما بابت همراهیتان');
    }
}
