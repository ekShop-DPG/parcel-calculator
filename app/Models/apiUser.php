<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apiUser extends Model
{
    use HasFactory;
    protected $guard = [];


    public function ipCheck(){
        return $this->hasMany(ipCheck::class,'api_user_id');
    }
}
