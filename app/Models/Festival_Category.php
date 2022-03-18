<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival_Category extends Model
{
    use HasFactory;
    protected $table='festival_categories';
    protected $guarded=[];

    public function festivals()
    {
        return $this->hasMany(Festival::class,'festival_category_id');
    }

}
