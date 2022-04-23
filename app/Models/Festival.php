<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;
    protected $table='festivals';
    protected $guarded=[];
    protected $appends = array('formatshow');


    public function getFormatshowAttribute()
    {
        if (!empty($this->formats)){
            return unserialize($this->formats);
        }
        return [];
    }
    public function category()
    {
        return $this->belongsTo(Festival_Category::class,'festival_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function files()
    {
        return $this->hasMany(Festival_File::class,'festival_id');
    }

    public function sponsors()
    {
        return $this->hasMany(Festival_Sponsor::class,'festival_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class,'festival_id');
    }

}
