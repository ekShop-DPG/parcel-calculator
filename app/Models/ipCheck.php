<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ipCheck extends Model
{
    use HasFactory;
    protected $guard = [];


    public function apiUser(){
        return $this->belongsTo(apiUser::class,'api_user_id','id');
    }
}
