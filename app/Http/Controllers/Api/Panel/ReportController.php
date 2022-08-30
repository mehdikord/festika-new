<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function files_types(Festival $festival)
    {
        if ($festival->user_id != get_user()->id){
            return response()->json(['error'=>"unauthorized "],401);
        }
        $types = unserialize($festival->formats);
        $result = [];
        foreach ($types as $type){
            if ($type === 'image'){
                $image = '/template/svg/image-ico.png';
            }elseif ($type === 'video'){
                $image = '/template/svg/video-ico.png';
            }elseif ($type === 'text'){
                $image = '/template/svg/text-ico.png';
            }elseif ($type === 'voice'){
                $image = '/template/svg/voice-ico.png';
            }else{
            $image = '/template/svg/image-ico.png';
            }
            $result[]=[
                'name'=> $type,
                'steps'=>$festival->files()->where('type',$type)->count(),
                'pictureSettings' => [
                    'src' => $image
                ],
            ];
        }
        return response()->json($result);
    }
}
