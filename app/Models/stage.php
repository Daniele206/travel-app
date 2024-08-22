<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stage extends Model
{
    use HasFactory;

    public function day(){
        return $this->belongsTo(day::class);
    }
    //day_id to stages
}
