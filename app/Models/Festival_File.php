<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival_File extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='festival_files';

    public function festival()
    {
        return $this->belongsTo(Festival::class,'festival_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
