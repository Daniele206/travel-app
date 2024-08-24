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

    protected $fillable=['title','slug','location','description','image'];
    //day_id to stages
}
