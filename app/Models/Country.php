<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $guard = [];
    public $timestamps = false;
    
    // public function countrySetting(){
    //     return $this->belongsTo(countrySetting::class,'country_id','id');
    // }
}
