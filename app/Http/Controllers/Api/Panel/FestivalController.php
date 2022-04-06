<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use App\Models\Festival_File;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function GuzzleHttp\Promise\all;

class FestivalController extends Controller
{
    public function get_all()
    {
        $data = Festival::query();
        $data->where('user_id',get_user()->id);
        return response()->json($data->orderByDesc('id')->with('category')->get());

    }

    public function store(Request $request)
    {
        $request->merge(['slug'=>str_replace(' ','-',$request->slug)]);
        $validation = Validator::make($request->all(),[
            'festival_category_id'=>'required|exists:festival_categories,id',
            'slug'=>'required|unique:festivals',
            'title'=>'required|max:225',
            'subtitle'=>'nullable|max:225',
            'sends'=>'nullable|min:1',
            'formats'=>'required|array',
            'sponsors'=>'nullable|array',
            'forms'=>'nullable|array',
            'period'=>'required|numeric',
            'disk'=>'required|numeric|min:1',
            'quantity'=>'nullable|numeric|min:100',
            'start_at'=>'required',
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
        //Forms
        $forms=null;
        if (count($request->forms)){
            try {
                $forms = json_encode($request->forms, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {

            }
        }
        $festival = Festival::create([
            'user_id'=>get_user()->id,
            'festival_category_id'=>$request->festival_category_id,
            'title'=>$request->title,
            'subtitle'=>$request->subtitle,
            'slug'=>$request->slug,
            'description'=>$request->description,
            'terms'=>$request->terms,
            'forms'=>$forms,
            'logo'=>$logo_url,
            'banner'=>$banner_url,
            'formats'=>$formats,
            'mimes'=>$mimes,
            'sends'=>$request->sends,
            'disk'=>$request->disk,
            'period'=>$request->period,
            'quantity'=>$request->quantity,
            'start_at'=>$start_at,
            'accepted'=>0,
        ]);
        $festival->update(['code'=>random_code($festival->id),'expire_at'=>$start_at->addDays($request->period)]);
        $invoice = Invoice::create([
            'user_id'=>get_user()->id,
            'festival_id'=>$festival->id,
            'price'=>100000,
            'title'=>'ایجاد جشنواره',
            'festival_disk'=>$request->disk,
            'festival_period'=>$request->period,
            'festival_quantity'=>$request->quantity,
        ]);
        $invoice->update(['code'=>random_code($invoice->id)]);

        //sponsors
        if (count($request->sponsors)){
            foreach ($request->sponsors as $sponsor){
                $sponsor_logo = null;
                if (!empty($sponsor['logo'])){
                    $photo_name = 'public/images/festivals/sponsors/'.Str::random(12).'.'.'jpg';
                    $photo = base64_to_jpeg($sponsor['logo'],$photo_name);
                    $sponsor_logo = asset(Storage::url($photo_name));
                }
                $festival->sponsors()->create([
                    'name'=>$sponsor['name'],
                    'link'=>$sponsor['link'],
                    'logo'=>$sponsor_logo,
                ]);


            }
        }

        return response()->json("success");

    }

    public function activation(Festival $festival)
    {
        if ($festival->user_id != get_user()->id){
            return response()->json(['error'=>"unauthorized "],401);
        }
        if ($festival->is_active == 1){
            $festival->update(['is_active' => 0]);
            return response()->json("جشنواره مورد نظر باموفقیت غیرفعال شد");
        }
        $festival->update(['is_active' => 1]);
        return response()->json("جشنواره مورد نظر باموفقیت فعال شد");

    }

    public function files($festival)
    {
        return response()->json(get_user()->festivals()->where("slug",$festival)->with('files')->with('files.user')->firstorfail());


    }

    public function show($festival)
    {
        return response()->json(get_user()->festivals()->where("slug",$festival)->with('category')->with('sponsors')->with('invoices')->firstorfail());


    }

    public function submit_form(Request $request,$slug)
    {
        $festival = Festival::where('slug',$slug)->where('is_active',true)->where('force_close',false)->where('accepted',true)->firstorfail();
        $mimes='';
        if (!empty($festival->mimes)){
            $mimes = unserialize($festival->mimes);
            $mimes = implode(',',$mimes);
        }
        $validation = Validator::make($request->all(),[
           'selected_file'=>"required|mimes:$mimes",
        ]);
        if ($validation->fails()){
            return response()->json($validation->errors(),421);
        }
        $forms=null;
        if ($request->filled('forms')){
            try {
                $forms = json_encode($request->forms, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
            }
        }
        $file=null;
        $size=0;
        $type=null;
        if ($request->file('selected_file')){
            $size=$request->file('selected_file')->getSize();
            $type = get_festival_file_format($request->file('selected_file')->extension());
            $file = Storage::put('private/festivals/posted/'.$festival->id,$request->file('selected_file'),'private');
        }
        $created = $festival->files()->create([
            'user_id'=>get_user()->id,
            'file'=>$file,
            'size'=>$size,
            'type'=>$type,
            'forms'=>$forms,
        ]);
        $created->update(['code'=>random_code($created->id,14)]);

        //Update festival information
        $festival->update(['files_count'=>$festival->files_count + 1,'disk_usage'=>$festival->disk_usage + $size]);
        return response()->json('کاربر گرامی اثر شما باموفقیت به جشنواره ارسال شد، شما متوانید از پنل کاربری خود آثار ارسال شده و نتایج را مشاهده کنید . ');
    }

    public function download_single($file)
    {
        $file = Festival_File::where('id',$file)->firstorfail();
        if (!empty($file->festival_id) && $file->festival->user_id == get_user()->id){
            return Storage::download($file->file,$file->code.'.'.get_file_extension($file->file));
        }
        return response()->json(['error'=>"unauthorized "],401);

    }

}
