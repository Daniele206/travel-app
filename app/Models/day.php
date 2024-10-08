<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class day extends Model
{
    use HasFactory;

    public function jurney(){
        return $this->belongsTo(Jurney::class);
    }

    public function stages(){
        return $this->hasMany(stage::class);
    }
}
