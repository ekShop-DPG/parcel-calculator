<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guard = [];

    
    public function countrySetting(){
        return $this->hasMany(countrySetting::class,'company_id','id');
    }
}
