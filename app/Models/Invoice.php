<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table='invoices';
    protected $guarded=[];

    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function festival()
    {
        return $this->belongsTo(Festival::class,'festival_id');
    }
}
