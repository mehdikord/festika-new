<?php

function helper_send_auth_sms($phone,$code)
{
    $req = new \GuzzleHttp\Client();
    $req->get("https://api.kavenegar.com/v1/307175483364594348624B776E2B313465525579445874386B736B4F514B556875792B58684C4D6B5779773D/verify/lookup.json?receptor=$phone&token=$code&template=festika-verification");
}

function helper_send_sms($phone,$message)
{
    try {
        $api = new \Kavenegar\KavenegarApi(env('KAVENEGAR_API_KEY'));
        $sender = 10008663;
        $result = $api->Send($sender, $phone, $message);
    }
    catch(ApiException | HttpException $e){
        echo $e->errorMessage();
    }

}

function helper_check_sms_time($id): bool
{
    $data = \App\Models\Auth_Sms::whereId($id)->first();
    $now_time = \Carbon\Carbon::now();
    $past_time = $now_time->diffInMinutes($data->updated_at);
    return !($past_time >= 2);
}

function base64_to_jpeg($base64_string,$output_file)
{
    $explode = explode(',',$base64_string);
    if ($explode[0] === "data:image/png;base64") {
        $img = str_replace('data:image/png;base64,', '', $base64_string);
    }elseif ($explode[0] === "data:image/jpg;base64"){
        $img = str_replace('data:image/jpg;base64,', '', $base64_string);
    }elseif ($explode[0] === "data:image/jpeg;base64"){
        $img = str_replace('data:image/jpeg;base64,', '', $base64_string);
    }else{
        return false;
    }
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
     \Illuminate\Support\Facades\Storage::put($output_file, $data);
}

function get_user(){
    return \App\Models\User::where('api_token',request()->header('Authorization'))->first();
}

//random code generator
/**
 * @throws Exception
 */
function random_code($unique = 1, $count = 10): string
{
    $length = $count - strlen($unique) ;
    $start =1;
    $end = 9;
    for($i=1;$i<$length;$i++){
        $start.=0;
        $end.=9;
    }
    return $unique.random_int($start,$end);
}

//mimes generator
function mimes_generator($mimes=[]): array
{
    $result=[];

    foreach ($mimes as $mime)
    {
        if ($mime==='video'){
            $result[]='mp4';
            $result[]='avi';
            $result[]='mpeg';
            $result[]='mkv';
            $result[]='fly';
        }
        if ($mime==='image'){
            $result[]='jpg';
            $result[]='jpeg';
            $result[]='png';
            $result[]='svg';
            $result[]='ico';
        }
        if ($mime==='text'){
            $result[]='txt';
            $result[]='pdf';
            $result[]='doc';
            $result[]='docx';
        }
        if ($mime==='audio'){
            $result[]='mp3';
            $result[]='wma';
        }
        if ($mime==='zip'){
            $result[]='rar';
            $result[]='zip';
            $result[]='7zip';
        }
    }
    return $result;
}

function get_festival_file_format($extension):string
{
    $result='';
    if (in_array($extension,array('mp4','avi','mpeg','mkv','fly'))){
        $result='video';
    }
    if (in_array($extension,array('jpg','jpeg','png','svg','ico'))){
        $result='image';
    }
    if (in_array($extension,array('txt','pdf','doc','docx'))){
        $result='text';
    }
    if (in_array($extension,array('mp3','wma'))){
        $result='audio';
    }
    if (in_array($extension,array('zip','rar','7zip'))){
        $result='zip';
    }
    return $result;
}
