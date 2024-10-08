<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurney extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function days(){
        return $this->hasMany(day::class);
    }

    protected $fillable=['title','slug','destination','leaving','return'];
}
